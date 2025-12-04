<?php
class UserAd {
    public int $id;
    public string $name;
    public User $creator;
    public string $size;
    public string $md5;
    public int $running;

    public DateTime $created_at;
    public DateTime $last_ran;

    public int $impressions;
    public int $clicks;
    public int $bid;

    public int $last_impressions;
    public int $last_clicks;
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
        $this->name = $ad["name"];
        $this->created_at = new DateTime($ad["created_at"]);
        $this->last_ran = new DateTime($ad["last_ran"]);
        $this->creator = new User($ad["creator"]);
        $this->size = $ad["size"];
        $this->running = $ad["running"];
        $this->impressions = $ad["impressions"];
        $this->clicks = $ad["clicks"];
        $this->bid = $ad["bid"];
        $this->last_impressions = $ad["last_impressions"];
        $this->last_clicks = $ad["last_clicks"];
        $this->last_bid = $ad["last_bid"];
    }

    public static function new(string $name, User $creator, string $size, string $md5) {
        global $db;

        $stmt = "INSERT INTO ads (`name`, `created_at`, `creator`, `size`, `md5`) VALUES (:xname, :created_at, :creator, :xsize, :md5)";
        $db->execute($stmt, [
            ":xname" => $name,
            ":created_at" => date("Y-m-d H:i:s"),
            ":creator" => $creator->getUserId(),
            ":xsize" => $size,
            ":md5" => $md5
        ]);
    }
};
?>