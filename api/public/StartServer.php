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

$stmt = "INSERT INTO servers (placeid, serverid, playerTable, port, `started`) VALUES (:placeid, :serverid, :playerTable, :port, :xstarted)";
$result = $db->execute($stmt, [
    ":placeid" => $placeId,
    ":serverid" => uniqid(),
    ":playerTable" => $playerTable,
    ":port" => $port,
    ":xstarted" => date("Y-m-d H:i:s")
]);

echo $port;

#$script = "wait(); dofile('http://".domain."/game/gameserver.ashx?serverPort=" . $port . "&PlaceID=".$placeId."')";
$script = "wait(); dofile('http://".domain."/game/gameserver.ashx?serverPort=" . $port . "&PlaceID=".$placeId."&2007=1')";
#$command = 'start C:\2009M3\Server2.exe -no3d -script "'.$script.'"';
$command = 'start C:\2007L\Server.exe -no3d -script "'.$script.'"';
popen($command, "r");
?>