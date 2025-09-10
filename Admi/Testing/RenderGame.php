<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();

$page = new APageBuilder;
$game = $_GET["ID"];
$stmt = "SELECT * FROM items WHERE itemType='game' AND itemId=:itemId";
$result = $db->execute($stmt, [":itemId" => $game]);
if ($result->rowCount() > 0) {
    $item = $result->fetch(PDO::FETCH_ASSOC);
    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/content/".$item["itemId"])) {
        $asset = new Asset($item["itemId"]);
        $asset->RequestThumbnail(420, 230, "PNG", true, true);
        $asset->RequestThumbnail(250, 250, "PNG", true, true);
    }
}

echo "Rendered!";
?>