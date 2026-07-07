<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url", $theme)), $theme, "/templates/authheader.php");
Ad::generateAd("160x600");
?>
