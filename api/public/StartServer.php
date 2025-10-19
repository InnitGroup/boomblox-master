<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

if (Setting::disabled("Gameservers")) {
    exit;
}

$placeId = $_GET["PlaceID"] ?? Server::_404();

$port = rand(1000,2000);
$playerTable = 'a:0:{}';

$stmt = "INSERT INTO servers (placeid, serverid, playerTable, port) VALUES (:placeid, :serverid, :playerTable, :port)";
$result = $db->execute($stmt, [
    ":placeid" => $placeId,
    ":serverid" => uniqid(),
    ":playerTable" => $playerTable,
    ":port" => $port
]);

echo $port;

$script = "wait(); dofile('http://".domain."/game/gameserver.ashx?serverPort=".$port."&PlaceID=".$placeId."')";
$command = 'start C:\2008L\Server4.exe -no3d -script "'.$script.'"';
popen($command, "r");

?>