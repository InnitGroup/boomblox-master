<?php
#made: 03/15/2025 @marsoc
#last edit: 03/15/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

#$invite = new InviteManager;
$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();
PageBuilder::addComponent("invite", "main");
$page->buildFooter();
?>