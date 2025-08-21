<?php
class Client {
    public static function getJoin() {
        global $db;
        $stmt = "SELECT clientjoin FROM users WHERE id=:id";
        $result = $db->execute($stmt, [":id" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            $clientjoin = $fetched["clientjoin"];
            if ($clientjoin > 0) {
                return $clientjoin;
            }
        }
    }
    
    public static function getType() {
        global $db, $user;
        $stmt = "SELECT clienttype FROM users WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $user->getUserId()]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            $clienttype = $fetched["clienttype"];
            if ($clienttype > 0) {
                return $clienttype;
            }
        }
    }

    public static function getServer() {
        global $db, $user;
        $stmt = "SELECT serverjoin FROM users WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $user->getUserId()]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            $clienttype = $fetched["serverjoin"];
            if ($clienttype > 0) {
                return $clienttype;
            }
        }
    }

    public static function setJoin($userId, $placeId) {
        global $db;
        $stmt = "UPDATE users SET clientjoin=:placeId WHERE id=:userId";
        $db->execute($stmt, [
            ":placeId" => $placeId,
            ":userId" => $userId
        ]);
    }
}
?>