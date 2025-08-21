<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
Client::setJoin($user->getUserId(), $_GET["PlaceID"]);
?>