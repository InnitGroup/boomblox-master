<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-type: text/plain");
global $auth;
    
if (!$auth->isAuthed()) {
    $file = new File("/api/private/lua/userjoin.lua", [
        "Port" => 53640,
        "Url" => url
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

if (!$user->isStaff()) { # staff bypass
    if ($user->getClientMd5() !== Server::currentClientMd5()) {
        $file = new File("/api/private/lua/joinfail.lua", [
            "Error" => "join, your client is not up to date.",
            "UserID" => $userId
        ]);
        echo $file->handle();
        exit;
    }

    if ($user->getTimeSinceLastClientMd5() > 120) {
        Client::clearType($user->getUserId());
        $file = new File("/api/private/lua/joinfail.lua", [
            "Error" => "join, your client failed to authenticate.",
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
    global $user;
    
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, this game is no longer running.",
        "UserID" => $userId
    ]);
    Client::setJoin($user->getUserId(), 0);
    
    echo $file->handle();
    exit;
}

if (!$user->canAccessPlace($server["placeId"])) {
    global $user;
    
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, you are not friends with this user.",
        "UserID" => $userId
    ]);
    Client::setJoin($user->getUserId(), 0);
    
    echo $file->handle();
    exit;
}

$port = $server["port"];
$uploadUrl = $user->ownsPlace($server["placeId"]) ? "http://".domain."/Data/Upload.ashx?id=" . $server["placeId"] : "";
$hasLocalScripts = File::hasLocalScripts($_SERVER["DOCUMENT_ROOT"] . "/content/" . $server["placeId"]);
$noLocalScripts = $hasLocalScripts ? '' : 'game["Script Context"]:Remove()';
$username = $user->getUsername();

if ($user->isGuest()) {
    $guestId = $user->guestId();
    $username = "Guest $guestId";
}

$file = new File("/api/private/lua/join.lua", [
    "UserID" => $userId, 
    "Username" => $username, 
    "Port" => $port,
    "ClientTicket" => $user->getTicket(),
    "NoLocalScripts" => $noLocalScripts,
    "UploadUrl" => $uploadUrl,
    "Url" => url,
    "SuperSafeChat" => ($user->isGuest() ? "true" : "false"),
    "IP" => Server::getServerIP()
]);

Client::clearType($user->getUserId());
echo $file->handle();
exit;
?>