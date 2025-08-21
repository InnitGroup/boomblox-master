<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$data = file_get_contents("php://input");
$data = json_decode($data);

PageBuilder::addComponent("friends", "list", compact("data"));
?>