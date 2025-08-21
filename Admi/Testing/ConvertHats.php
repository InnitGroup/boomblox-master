<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);

exit;
$stmt = "SELECT * FROM items WHERE `itemType`='catalog' AND `catalogType`='Hat' AND `fileName` != ''";
$result = $db->execute($stmt);
if ($result->rowCount() > 0) {
    $shirts = $result->fetchAll(PDO::FETCH_ASSOC);
    $shirtsA = 0;
    foreach ($shirts as $shirt) {
        $shirtsA += 1;
        $file = $_SERVER["DOCUMENT_ROOT"]."/content/hatsToMigrate/".$shirt["fileName"].".rbxmx";
        if (file_exists($file)) {
            $contents = file_get_contents($file);
            $newFile = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/migratedHats/".$shirt["itemId"], $contents);
        }
    }
}
?>