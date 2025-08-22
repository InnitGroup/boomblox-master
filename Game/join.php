<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-type: text/plain");

if (!isset($_COOKIE["BROBLOSECURITY"])) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "authenticate, try logging in through the client."
    ]);
    echo $file->handle();
    exit;
}

$userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
$user = new User($userId);

if (!isset($_GET["ServerID"])) {
    $file = new File("/api/private/lua/userjoin.lua", [
        "Port" => 53640,
        "Url" => url
    ]);

    echo $file->handle();
    exit;
}

$serverId = $_GET["ServerID"];

if (Gameservers::isFull($serverId)) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, server is full.",
        "UserID" => $userId
    ]);
    echo $file->handle();
    exit;
}

if ($user->isInGame()) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, you can not play multiple games at once.",
        "UserID" => $userId
    ]);
    echo $file->handle();
    exit;
}

if (Setting::disabled("Gameservers")) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, gameservers are disabled.",
        "UserID" => $userId
    ]);
    echo $file->handle();
    exit;
}

if (!$server = Gameservers::getServerById($serverId)) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, this game is no longer running.",
        "UserID" => $userId
    ]);
    echo $file->handle();
    exit;
}

$port = $server["port"];
$uploadUrl = $user->ownsPlace($server["placeId"]) ? "http://".domain."/Data/Upload.ashx?id=" . $server["placeId"] : "";

$file = new File("/api/private/lua/join.lua", [
    "UserID" => $userId, 
    "Username" => $user->getUsername(), 
    "Port" => $port,
    "ClientTicket" => $user->getTicket(),
    "UploadUrl" => $uploadUrl,
    "Url" => url
]);

echo $file->handle();
exit;



?>