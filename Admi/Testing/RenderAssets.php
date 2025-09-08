<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);

#exit;
$stmt = "SELECT * FROM items WHERE `catalogType`='Pants'";
$result = $db->execute($stmt);
if ($result->rowCount() > 0) {
    $items = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($items as $item) {
        echo $item["itemId"];
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/content/".$item["itemId"])) {
            $asset = new Asset($item["itemId"]);
            $asset->RequestThumbnail(250, 250, "PNG", true, true);
        }
    }
}

echo "Rendered!";

?>