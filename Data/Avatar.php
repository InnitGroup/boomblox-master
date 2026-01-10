<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;
header("Content-Type: image/png");
$userId = isset($_GET["userId"]) ? (int)$_GET["userId"] : $db->getIdByUser($_GET["username"]);
$avatar = new Avatar($userId);

echo file_get_contents($avatar->GetThumbnail(500, 500, "PNG"));
?>