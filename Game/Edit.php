<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
global $user, $auth;

if (!$auth->isAuthed()) {
	Server::_404();
}

if (!isset($_GET["PlaceID"])) {
	Server::_404();
}

$placeId = $_GET["PlaceID"];
if (!$user->ownsPlace($placeId)) {
	$file = new File("/api/private/lua/joinfail.lua", [
		"Error" => "edit place, this place is not yours."
	]);
	
	echo $file->handle();
	exit;
}

$uploadUrl = in_array($placeId, $user->getPlaces(true)) ? "http://".domain."/Data/Upload.ashx?id=" . $placeId : "";

$file = new File("/api/private/lua/edit.lua", [
	"UserId" => $user->getUserId(),
	"PlaceId" => $placeId,
	"UploadUrl" => $uploadUrl,
	"Url" => url
]);

Client::clearType($user->getUserId());
echo $file->handle();
exit;
?>