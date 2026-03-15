<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$userId = isset($_GET["userId"]) ? (int)$_GET["userId"] : NULL;

if ($userId) {
    $renderedUser = new User($userId);
    $altHash = md5($renderedUser->getAlternateAppearance());

    global $db;
    $stmt = "DELETE FROM cdn WHERE altHash=:altHash";
    $db->execute($stmt, [":altHash" => $altHash]);

    $avatar = new Avatar($userId);
    $avatar->RequestThumbnail(540, 660, "PNG", true, true);
    $new = $avatar->RequestThumbnail(500, 500, "PNG", true, true);
    $avatar->RequestThumbnail(100, 100, "JPG", true, true);
    
    echo $new;
}
?>