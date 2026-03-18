<?php
# for client interaction and data handling
class Client {
    public static function getMd5($version) {
        $md5s = [
            "035" => "5c7bff8eb01b07f9965e15d7fb624fc1",
            "034" => "cec71839990fa724e0b1ffd8e041a77f",
            "033C" => "32e3789576b3379e5067fa4e376a5a81",
            "030D" => "83888fa47ddc4eac3795860629c2f545"
        ];

        return $md5s[$version] ?? NULL;
    }
    # gets the place that the user is prepared to join
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
    
    # gets the type of joining action the user is performing (online, solo, edit)
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

    # gets the server that the user is prepared to join
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

    # sets the ticket data for joining
    public static function setJoin($userId, $placeId) {
        global $db;
        $stmt = "UPDATE users SET clientjoin=:placeId WHERE id=:userId";
        $db->execute($stmt, [
            ":placeId" => $placeId,
            ":userId" => $userId
        ]);
    }

    # clear type
    public static function clearType($userId) {
        global $db;
        $stmt = "UPDATE users SET clienttype=0 WHERE id=:userId";
        $db->execute($stmt, [
            ":userId" => $userId
        ]);
    }
}
?>