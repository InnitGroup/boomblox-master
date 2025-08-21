<?php
#made: 02/06/2025 @marsoc
#last edit: 02/16/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
Controller::requireAuth();
!isset($_GET["format"]) && header("HTTP/1.1 404 Not Found");

$format = $_GET["format"];
/*
interface: 200x300
invitation & forum: 64x64
profile: 180x220
friend: 100x100
list: 48x48
*/

$height;
$width;
switch ($format) {
    case "interface":
        $width = 200;
        $height = 300;
        break;
    case "invitation":
        $width = 64;
        $height = 64;
        break;
    case "forum":
        $width = 64;
        $height = 64;
        break;
    case "profile":
        $width = 180;
        $height = 220;
        break;
    case "friend":
        $width = 100;
        $height = 100;
        break;
    case "list":
        $width = 48;
        $height = 48;
        break;
}

global $db;
$users = $db->getAllUsers();
$users = $users->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    $render = new Avatar($user["id"]);
    $render->RequestThumbnail();
}
?>