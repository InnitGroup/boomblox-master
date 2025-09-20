<?php
#made: 02/26/2025 @marsoc
#last edit: 02/26/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$abuse = new AbuseManager;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Report User", $theme, "/templates/dryheader.php");
$page->buildHeader();

$report = new ReportUserManager;

PageBuilder::addComponent("report", "userprofile");

$page->buildFooter();
?>