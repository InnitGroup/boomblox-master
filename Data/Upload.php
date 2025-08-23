<?php
#init
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $db;
$data = gzdecode(file_get_contents("php://input"));
// test
$placeId = (int)$_GET["id"];
if (!$user->ownsPlace($placeId)) {
    Server::_404();
}

#write
$filePath = $_SERVER["DOCUMENT_ROOT"] . "/content/" . $placeId;
$compressedData = gzencode($data, 9);
file_put_contents($filePath, $compressedData);

$file = new File("/content/$placeId");
$file->links();

$stmt = "UPDATE items SET lastUpdate = :lastUpdate WHERE itemId=:itemId";
$db->execute($stmt, [":lastUpdate" => date('Y-m-d H:i:s'), ":itemId" => $placeId]);

#render
$asset = new Asset($placeId);
$asset->RequestThumbnail(420, 230, "PNG");
$render = $asset->RequestThumbnail(250, 250, "PNG");

?>