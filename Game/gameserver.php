<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
global $user, $auth;
Server::ipLock();

if (!Server::isLocal()) {
    exit;
}

$port = $_GET["serverPort"] ?? 10000;
$place = $_GET["PlaceID"] ?? 1;

if ($auth->isAuthed()) {
    echo 1;
    exit;
}

if (Setting::disabled("Gameservers")) {
    exit;
}

$file = new File("/api/private/lua/gameserver.lua", [
    "Port" => $port, 
    "PlaceID" => $place, 
    "Url" => url
]);
echo $file->handle();
?>