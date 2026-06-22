<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db, $user;
!$auth->isAuthed() && Server::_404();

$page = new APageBuilder;

print_r($user->getItems("model"));
?>