<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

$stmt = "SELECT DISTINCT victim FROM `statistics` WHERE killer=76";
$result = $db->execute($stmt);
$fetched = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($fetched as $row) {
    echo $row["victim"] . "<br>";
}
?>