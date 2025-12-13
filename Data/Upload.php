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
str_replace("IncommingConnection", "-- why would you do that {$user->getUsername()}", $data);

$version = Version::getVersion($placeId); # should return 1
if (Version::assetExists($placeId)) { # true
    file_put_contents($filePath . "_" . $version, file_get_contents($filePath)); # replace /content/1_1 with /content/1
} #

if (strlen($data) > 30000000) {
    Server::_404();
}

file_put_contents($filePath, $data);
$file = new File("/content/$placeId");
$file->links();
$playerCount = $file->getPlayerCount();

$compressedData = gzencode($data, 9);
file_put_contents($filePath, $compressedData);

$stmt = "UPDATE items SET lastUpdate = :lastUpdate, playersMax = :playerCount WHERE itemId=:itemId";
$db->execute($stmt, [
    ":lastUpdate" => date('Y-m-d H:i:s'), 
    ":playerCount" => $playerCount,
    ":itemId" => $placeId
]);

$newVersion = Version::getNextVersion($placeId);
Version::logVersion($placeId, $newVersion); #
Version::setVersion($placeId, $newVersion);

#render
$asset = new Asset($placeId);
$asset->RequestThumbnail(420, 230, "PNG");
$render = $asset->RequestThumbnail(250, 250, "PNG");
exit;
?>