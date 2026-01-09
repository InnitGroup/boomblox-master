<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;
header("Content-Type: image/png");
$userId = (int)$_GET["userId"];
$avatar = new Avatar($userId);

echo file_get_contents($avatar->GetThumbnail(500, 500, "PNG"));
?>