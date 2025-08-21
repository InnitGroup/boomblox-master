<?php
class ROBLOSECURITY {
    public static function new($userid = null) {
        $start = "dontsharethiswithanyone-";
        $roblosecurity = $start.strtoupper(bin2hex(random_bytes(120)));
        if ($userid) {
            global $db;
            $stmt = "UPDATE users SET `roblosecurity`='$roblosecurity' WHERE id=:id";
            $db->execute($stmt, [":id" => (int)$userid]);
        }
        return $roblosecurity;
    }
    public static function match($roblosecurity) {
        global $db;
        $stmt = "SELECT * FROM users WHERE `roblosecurity`='$roblosecurity'";
        $result = $db->execute($stmt);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched["id"];
        } else {
            return false;
        }
    }
    public static function get($userid) {
        global $db;
        $stmt = "SELECT * FROM users WHERE id=:userid";
        $result = $db->execute($stmt, [":userid" => $userid]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched["roblosecurity"];
        } else {
            return false;
        }
    }
    public static function set($userId) {
        setcookie("BROBLOSECURITY", self::get($userId), time() + (60*60*24*30), "/", "", false, true); #https://www.php.net/manual/en/function.setcookie.php
    }
    public static function detach($userId, $isLocal = false) {
        global $db;
        $stmt = "UPDATE users SET `roblosecurity`=:roblosecurity WHERE `id`=:id";
        $db->execute($stmt, [":roblosecurity" => self::new((int)$userId), ":id" => (int)$userId]);
        if ($isLocal) {
            setcookie("BROBLOSECURITY", self::new($userId), time() - 3600, "/", "", false, true);
        }
    }
    public static function fullgen() {
        global $db;
        $stmt = "SELECT * FROM users";
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetched as $user) {
            $roblosecurity = self::new();
            $id = $user["id"];
            $stmt = "UPDATE users SET roblosecurity='$roblosecurity' WHERE id=$id";
            $db->execute($stmt);
        }
        Sitelog::add("ROBLOSECURITY cookies generated for all users");
    }
}
?>