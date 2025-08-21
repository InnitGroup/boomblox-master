<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
global $user;

if (!isset($_COOKIE["BROBLOSECURITY"])) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "authenticate, try logging in through the client."
    ]);
    echo $file->handle();
    exit;
}

if (isset($_GET["PlaceID"])) {
	$placeId = $_GET["PlaceID"];
	if (!$user->ownsPlace($placeId)) {
		exit;
	}

	$uploadUrl = $user->ownsPlace($placeId) ? "http://".domain."/Data/Upload.ashx?id=" . $placeId : "";

	$file = new File("/api/private/lua/visit.lua", [
		"PlaceId" => $placeId,
		"UserID" => $user->getUserId(),
		"Username" => $user->getUsername(), 
		"CharacterAppearance" => $user->getCharacterAppearance(), 
		"UploadUrl" => $uploadUrl,
		"Url" => url
	]);
	echo $file->handle();
} else {
	$file = new File("/api/private/lua/playsolo.lua", [
		"UserID" => $user->getUserId(),
		"Username" => $user->getUsername(), 
		"CharacterAppearance" => $user->getCharacterAppearance()
	]);
	echo $file->handle();
}
?>