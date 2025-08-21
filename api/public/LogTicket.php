<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
#Server::lockAPI();

global $db;
$ticket = $_GET["Ticket"];

$stmt = "SELECT joincode FROM users WHERE joincode=:ticket";
$result = $db->execute($stmt, [":ticket" => $ticket]);
if ($result->rowCount() > 0) {
    $fetched = $result->fetch(PDO::FETCH_ASSOC);
    $stmt = "UPDATE users SET joincode=NULL WHERE joincode=:ticket";
    $db->execute($stmt, [":ticket" => $ticket]);
}
?>