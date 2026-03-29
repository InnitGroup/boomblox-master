<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;

$serverId = $_GET["ServerID"];
if (!$server = Gameservers::getServerById($serverId)) {
    exit;
}

$placeId = $server["placeId"];

if (!$user->ownsPlace($placeId)) {
    if (!$user->hasPerms(3)) {;
        exit;
    }
}

$port = $server["port"]; # - 1001;
file_get_contents(fullDomain . "/api/public/CloseServer.php?Port=$port&Key=" . Gameservers::getAPIKey("Close"));
?>