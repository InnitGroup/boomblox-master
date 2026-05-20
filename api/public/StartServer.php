<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

if (Setting::disabled("Gameservers")) {
    exit;
}

$placeId = $_GET["PlaceID"] ?? Server::_404();
$stmt = "SELECT itemType FROM items WHERE itemId=:placeId AND itemType='game'";
$result = $db->execute($stmt, [":placeId" => $placeId]);
if ($result->rowCount() == 0) {
    exit;
}

$port = rand(31000, 32000);
$playerTable = 'a:0:{}';

$stmt = "INSERT INTO servers (placeid, serverid, playerTable, port) VALUES (:placeid, :serverid, :playerTable, :port)";
$result = $db->execute($stmt, [
    ":placeid" => $placeId,
    ":serverid" => uniqid(),
    ":playerTable" => $playerTable,
    ":port" => $port
]);

echo $port;

$script = "wait(); loadfile('http://".domain."/game/gameserver.ashx?serverPort=" . $port . "&PlaceID=".$placeId."')()";
#$command = 'start C:\2009M1\server2.exe'; # 
$command = 'start C:\2009M1\server3.exe -no3d -script "'.$script.'"';
popen($command, "r");
?>