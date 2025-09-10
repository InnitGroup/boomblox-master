<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;

$stmt = "SELECT * FROM items WHERE itemType='catalog'";
$result = $db->execute($stmt);
$fetched = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($fetched as $place) {
 
    $xml = (file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$place["itemId"]));
    $xml = str_replace("bmblox.xyz", "xoblog.dev", $xml);
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$place["itemId"], ($xml));

}
?>