<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$user = new User($_GET["userId"]);
echo $user->getCharacterAppearance();
?>