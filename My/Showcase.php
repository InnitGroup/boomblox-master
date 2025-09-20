<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." | My Showcase", $theme, "/templates/authheader.php");
$page->buildHeader();

PageBuilder::addComponent("showcase", "main", compact("theme"));

$page->buildFooter();
?>