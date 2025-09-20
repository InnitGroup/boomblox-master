<?php
#made: 03/15/2025 @marsoc
#last edit: 03/15/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$balance = new BalanceManager($theme);

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Account Balance", $theme, "/templates/authheader.php");
$page->buildHeader();
$balance->load();
$page->buildFooter();
?>