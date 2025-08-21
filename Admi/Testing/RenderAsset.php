<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);

exit;
$assetId = $_GET["ID"];
$stmt = "SELECT * FROM items WHERE itemId=:assetId";
$result = $db->execute($stmt, [":assetId" => $assetId]);
if ($result->rowCount() > 0) {
    $item = $result->fetch(PDO::FETCH_ASSOC);
    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/content/".$item["itemId"])) {
        $asset = new Asset($item["itemId"]);
        $asset->RequestThumbnail(250, 250, "PNG", true, true);
    }
}

echo "Rendered!";
?>