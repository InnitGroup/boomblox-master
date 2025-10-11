<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
!$auth->isAuthed() && Server::_404();

$user = new User(91);
echo count($user->getFriends(false))
?>