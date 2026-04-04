<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

if (Setting::disabled("Gameservers")) {
    exit;
}

$placeId = $_GET["PlaceID"] ?? Server::_404();


# $localPort = rand(30000, 31000); # 31000 - 32000
# $remotePort = $localPort + 1001; # 32001 - 33001
# $serverPort = $remotePort + 1001; # 33002 - 34002
$port = rand(31000, 32000);

$playerTable = 'a:0:{}';

$stmt = "INSERT INTO servers (placeid, serverid, playerTable, port) VALUES (:placeid, :serverid, :playerTable, :port)";
$result = $db->execute($stmt, [
    ":placeid" => $placeId,
    ":serverid" => uniqid(),
    ":playerTable" => $playerTable,
    ":port" => $port
]);

/*
$clientToml = new File("/api/private/toml/client.toml", [
    "serverAddr" => Server::getServerIP(),
    "serverPort" => $serverPort,
    "localPort" => $localPort,
    "localIP" => "127.0.0.1",
    "remotePort" => $remotePort
]);

$serverToml = new File("/api/private/toml/server.toml", [
    "bindPort" => $serverPort
]);

file_put_contents("C:/frp/temp/frpc$localPort.toml", $clientToml->handle());
file_put_contents("C:/frp/temp/frps$localPort.toml", $serverToml->handle());
*/

echo $port;

$script = "wait(); dofile('http://".domain."/game/gameserver.ashx?serverPort=".$port."&PlaceID=".$placeId."')";
$command = 'start C:\2009E4\Server.exe -no3d -script "'.$script.'"';
popen($command, "r");

$udp = "start C:/udp/sudppipe.exe -p 103.60.12.84 $port $port";
popen($udp, "rb");
/*
$frpc = "start C:/frp/frpc.exe -c C:/frp/temp/frpc$localPort.toml";
$frps = "start C:/frp/frps.exe -c C:/frp/temp/frps$localPort.toml";
popen($frps, "r");
popen($frpc, "r");
*/
?>