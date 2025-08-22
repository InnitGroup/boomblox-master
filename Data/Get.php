<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
$placeId = (int)$_GET["id"];

if (!Server::isLocal()) {
    global $user;
    if ($_SERVER["HTTP_USER_AGENT"] !== "Roblox/WinInet") {
        Server::_404();
        if (!in_array($placeId, $user->getPlaces(true))) {
            Server::_404();
        }
    }
}

echo gzdecode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$placeId));
?>