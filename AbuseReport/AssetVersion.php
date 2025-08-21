<?php
#made: 02/26/2025 @marsoc
#last edit: 02/26/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$abuse = new AbuseManager;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Report Asset", $theme, "/templates/dryheader.php");
$page->buildHeader();

PageBuilder::addComponent("report", "asset");

$page->buildFooter();
?>