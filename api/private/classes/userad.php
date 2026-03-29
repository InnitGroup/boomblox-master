<?php
class UserAd {
    public int $id;
    public int $assetId;
    public User $creator;

    public string $name;
    public string $size;
    public string $md5;
    public string $status;

    public DateTime $created_at;
    public DateTime $last_ran;

    public int $impressions;
    public int $clicks;
    public int $bid;
    public int $archived;

    public array $last_impressions;
    public array $last_clicks;
    public int $last_bid;

    public function __construct(int $id) {
        global $db;

        $stmt = "SELECT * FROM ads WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $id]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $ad = $result->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->assetId = $ad["assetId"];
        $this->name = $ad["name"];
        $this->md5 = $ad["md5"];
        $this->created_at = new DateTime($ad["created_at"]);
        $this->last_ran = new DateTime($ad["last_ran"]);
        $this->creator = new User($ad["creator"]);
        $this->size = $ad["size"];
        $this->status = $ad["status"];
        $this->impressions = $ad["impressions"];
        $this->clicks = $ad["clicks"];
        $this->bid = $ad["bid"];
        $this->last_impressions = $ad["last_impressions"] !== NULL ? unserialize($ad["last_impressions"]) : array();
        $this->last_clicks = $ad["last_clicks"] !== NULL ? unserialize($ad["last_clicks"]) : array();
        $this->last_bid = $ad["last_bid"];
        $this->archived = $ad["archived"];
    }

    public function id() { return $this->id; }
    public function assetId() { return $this->assetId; }
    public function name() { return $this->name; }
    public function creator() { return $this->creator; }
    public function size() { return $this->size; }
    public function md5() { return $this->md5; }
    public function status() { return $this->status; }
    public function impressions() { return $this->impressions; }
    public function clicks() { return $this->clicks; }
    public function bid() { return $this->bid; }
    public function last_impressions() { return $this->last_impressions; }
    public function last_clicks() { return $this->last_clicks; }
    public function last_bid() { return $this->last_bid; }
    public function last_ctr() { return count($this->last_impressions) > 0 ? round((count($this->last_clicks)/count($this->last_impressions)), 2) * 100 . "%" : "0%"; }
    public function ctr() { return $this->impressions > 0 ? round(($this->clicks/$this->impressions), 2) * 100 . "%" : "0%"; }
    public function last_ran() { return $this->last_ran; }
    public function created_at() { return $this->created_at; }

    public function placeBid(int $amount) {
        global $db;

        if ($amount < 1) {
            return;
        }

        if ($this->creator->hasTix($amount)) {
            $this->creator->takeTix($amount);
            $stmt = "UPDATE ads SET last_impressions = NULL, last_clicks = NULL, last_bid = :bid, bid = bid + last_bid, `status` = 'running', last_ran = :xnow WHERE id=:adId";
            $db->execute($stmt, [
                ":bid" => $amount,
                ":xnow" => date("Y-m-d H:i:s"),
                ":adId" => $this->id()
            ]);
        }
    }

    public function deactivate() {
        global $db;

        $stmt = "UPDATE ads SET `status` = 'stopped' WHERE id=:adId";
        $db->execute($stmt, [":adId" => $this->id()]);
    }

    # static ->deactivate()
    public static function remove(int $id) {
        global $db, $user;

        $stmt = "UPDATE ads SET `status` = 'stopped', `archived` = 1 WHERE id=:adId AND creator=:userId";
        $db->execute($stmt, [
            ":adId" => $id,
            ":userId" => $user->getUserId()
        ]);
    }

    public function checkIfValid() {
        $daysSinceRan = Helper::bTimeAgo($this->last_ran());
        if ($daysSinceRan > 0) {
           $this->deactivate();
        }
    }

    public function addImpression() {
        global $db, $user;

        $impressions = $this->last_impressions();
        
        if (!in_array($user->getUserId(), $impressions)) {

            array_push($impressions, $user->getUserId());
            $stmt = "UPDATE ads SET last_impressions = :last_impressions, impressions = impressions + 1 WHERE id=:adId";
            $db->execute($stmt, [
                ":last_impressions" => serialize($impressions),
                ":adId" => $this->id()
            ]);
        }
    }

    public function addClick() {
        global $db, $user;

        $clicks = $this->last_clicks();
        
        if (!in_array($user->getUserId(), $clicks)) {

            array_push($clicks, $user->getUserId());
            $stmt = "UPDATE ads SET last_clicks = :last_clicks, clicks = clicks + 1 WHERE id=:adId";
            $db->execute($stmt, [
                ":last_clicks" => serialize($clicks),
                ":adId" => $this->id()
            ]);
        }
    }

    public function getImage() {
        switch ($this->status()) {
            case "pending":
                return "https://t2." . domain . "/unavail-250x250.png";
                break;
            case "rejected":
                return "https://t2." . domain . "/unapproved-250x250.png";
                break;
            default:
                return "https://t4." . domain . "/{$this->md5()}";
                break;
        }
    }

    public static function new(string $name, User $creator, string $size, string $md5, int $assetId) {
        global $db;

        $stmt = "INSERT INTO ads (`name`, `created_at`, `creator`, `size`, `md5`, `assetId`) VALUES (:xname, :created_at, :creator, :xsize, :md5, :assetId)";
        $db->execute($stmt, [
            ":xname" => $name,
            ":created_at" => date("Y-m-d H:i:s"),
            ":creator" => $creator->getUserId(),
            ":xsize" => $size,
            ":md5" => $md5,
            ":assetId" => $assetId
        ]);
    }

    public static function exists(int $id) {
        global $db;

        $stmt = "SELECT id FROM ads WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $id]);
        return $result->rowCount() > 0;
    }
};
?>