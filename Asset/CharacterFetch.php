<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth, $user;
!$auth->isAuthed() && Server::_404();

echo $user->getCharacterAppearance();
?>