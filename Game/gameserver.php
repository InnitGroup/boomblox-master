<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
global $user, $auth;

$port = $_GET["serverport"] ?? 10000;
$place = $_GET["placeid"] ?? 1;

if (!Server::isLocal()) {
    $file = new File("/api/private/lua/usergameserver.lua", [
        "Url" => url,
        "Port" => 53640
    ]);
    echo $file->handle();
    exit;
}

Server::ipLock();
if (Setting::disabled("Gameservers")) {
    exit;
}

$file = new File("/api/private/lua/gameserver.lua", [
    "Port" => $port, 
    "PlaceID" => $place, 
    "Url" => url
]);
echo $file->handle();
exit;
?>