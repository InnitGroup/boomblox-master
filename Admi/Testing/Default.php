<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

exit;
$stmt = "SELECT username FROM users";
$result = $db->execute($stmt);
$users = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) {
    echo $user["username"]."<br>";
}

?>