<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

$stmt = "SELECT itemId FROM items WHERE itemType='game'";
$result = $db->execute($stmt);
$fetched = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($fetched as $row) {
    if (Version::getVersion($row["itemId"]) == 1) {
    Version::logVersion($row["itemId"], 1);
    }
}
?>