<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$userId = isset($_GET["userId"]) ? (int)$_GET["userId"] : NULL;

if ($userId) {
    $avatar = new Avatar($userId);
    $avatar->RequestThumbnail(540, 660, "PNG");
    $avatar->RequestThumbnail(500, 500, "PNG");
    $avatar->RequestThumbnail(100, 100, "JPG");
    
    echo $avatar->GetThumbnail(500, 500, "PNG");
}
?>