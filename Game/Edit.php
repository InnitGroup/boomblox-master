<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");

global $user;

if (!isset($_COOKIE["BROBLOSECURITY"])) {
	Server::_404();
}

$placeId = $_GET["PlaceID"];
$userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
$user = new User($userId);
$uploadUrl = in_array($placeId, $user->getPlaces(true)) ? "http://".domain."/Data/Upload.ashx?id=" . $placeId : "";

$file = new File("/api/private/lua/edit.lua", [
	"UserId" => $userId,
	"PlaceId" => $placeId,
	"UploadUrl" => $uploadUrl,
	"Url" => url
]);
echo $file->handle();
?>