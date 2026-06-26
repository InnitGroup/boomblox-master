<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

$page = new PageBuilder("Contact " . Site::getThemeProperty("alias", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();

PageBuilder::addComponent("info", "contactus");

$page->buildFooter();
?>