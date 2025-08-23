<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: text/plain");
global $user, $auth, $db;

if (!$auth->isAuthed()) {
    $file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "authenticate, try logging in through the client."
    ]);
    echo $file->handle();
    exit;
}

$stmt = "SELECT onsale FROM items WHERE itemId=:placeId";
$result = $db->execute($stmt, [":placeId" => $_GET["PlaceID"]]);
if ($result->rowCount() == 0) {
	$file = new File("/api/private/lua/joinfail.lua", [
        "Error" => "join, place doesn't exist."
    ]);
    echo $file->handle();
    exit;
}

$onsale = $result->fetch(PDO::FETCH_ASSOC)["onsale"];
$copylocked = $onsale !== 2;

if (isset($_GET["PlaceID"])) {
	$placeId = $_GET["PlaceID"];
	if (!$user->ownsPlace($placeId) && $copylocked) {
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