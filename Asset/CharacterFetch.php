<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth;
!$auth->isAuthed() && Server::_404();
?>

http://<?=domain?>/Asset/BodyColors.ashx?userId=3