<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new PageBuilder(Site::getThemeProperty("alias",$theme) . " Login", $theme, "/templates/dryheader.php");
$page->buildHeader();
PageBuilder::addComponent("info", "privacy");
$page->buildFooter();
?>