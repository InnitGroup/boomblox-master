<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-type: text/plain");

$user = new User($_GET["userId"]);
echo $user->getCharacterAppearance();
?>