<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
$placeId = isset($_GET["id"]) ? (int)$_GET["id"] : Server::_404();

if (!Server::isLocal()) {
    global $user;

    if ($_SERVER["HTTP_USER_AGENT"] !== "Roblox/WinInet") {
        Server::_404();
    }

    $item = new Item($placeId);
    if (!in_array($placeId, $user->getPlaces(true)) && !$item->isCopylocked()) {
        Server::_404();
    }
}

$data = gzdecode(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$placeId));
$data = str_replace("IncommingConnection", "-- why would you do that", $data);
$data = str_replace("CreateLocalPlayer", "-- why would you do that", $data);
$data = str_replace("game:Load(", "-- why would you do that", $data);
$data = str_replace("Game:Load(", "-- why would you do that", $data);
$data = str_replace("game:HttpGet(", "-- why would you do that", $data);
$data = str_replace("game:HttpPost(", "-- why would you do that", $data);
$data = str_replace("SetUploadUrl", "-- why would you do that", $data);
echo $data;
?>