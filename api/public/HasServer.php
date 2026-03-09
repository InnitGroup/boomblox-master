<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

if (Setting::disabled("Gameservers")) {
    exit("-1");
}

$placeId = $_POST["PlaceID"] ?? exit("-1");

$stmt = "SELECT * FROM servers WHERE placeId=:placeId ORDER BY players ASC LIMIT 1";
$result = $db->execute($stmt, [":placeId" => $placeId]);
if ($result->rowCount() > 0) {
    $stmt = "SELECT playersMax from items WHERE itemId=:placeId";
    $playersMaxResult = $db->execute($stmt, [":placeId" => $placeId]);
    $playersMax = $playersMaxResult->fetch(PDO::FETCH_ASSOC)["playersMax"];

    while ($server = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($server["players"] >= $playersMax) {
            exit("-2");
        }
    }

    exit("1");
}

exit("0");
?>