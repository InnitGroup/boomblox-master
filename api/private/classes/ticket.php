<?php
class Ticket {
    private $hash;
    private object $info;
    public function __construct($hash) {
        $this->hash = $hash;
        $init = $this->initInfo();
    }

    public function deactivate() {
        global $db;
        $stmt = "UPDATE tickets SET active=0 WHERE `ticketHash`=:ticketHash";
        return $db->execute($stmt, [":ticketHash" => $this->hash]);
    }

    public function initInfo() {
        global $db;
        $stmt = "SELECT * FROM tickets WHERE `ticketHash`=:ticketHash";
        $result = $db->execute($stmt, [":ticketHash" => $this->hash]);
        if ($result->rowCount() !== 0) {
            $info = $result->fetch(PDO::FETCH_ASSOC);
            $this->info = (object)[
                "userid" => $info["userid"],
                "type" => $info["ticketType"],
                "issued" => new DateTime($info["issued"]),
                "hash" => $this->hash,
                "active" => $info["active"]
            ];
            return true;
        } else {
            Server::_404();
        }
    }

    public function isActive() {
        return $this->info->active == 1;
    }

    public function isRecent() {
        return Helper::bTimeAgo($this->info->issued) < 7;
    }

    public function getType() {
        return $this->info->type;
    }

    public function getUser($isObject = false) {
        if ($isObject) {
            return new User($this->info->userid);
        }
        return $this->info->userid;
    }

    public function getInfo() {
        return $this->info;
    }
}
?>