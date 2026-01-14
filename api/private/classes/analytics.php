<?php

# for internal analytics to the database
class Analytics {

    # logs a new analytic as a join
    public static function logJoin($userId, $placeId) {
        global $db;
        $stmt = "INSERT INTO analytics (player, place, actiondate, actiontype) VALUES (:userId, :placeId, :actiondate, 'join')";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":placeId" => $placeId,
            ":actiondate" => date("Y-m-d H:i:s")
        ]);
    }

    public static function logLeave($userId, $placeId) {
        global $db;
        $stmt = "INSERT INTO analytics (player, place, actiondate, actiontype) VALUES (:userId, :placeId, :actiondate, 'leave')";
        $db->execute($stmt, [
            ":userId" => $userId,
            ":placeId" => $placeId,
            ":actiondate" => date("Y-m-d H:i:s")
        ]);
    }
};
?>