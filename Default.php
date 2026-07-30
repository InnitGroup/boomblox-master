<?php
#made: 01/04/2025 @marsoc
#last edit: 01/19/2025 @marsoc: added news loading
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], ["rbxnews", "marquee"]);
$page->buildHeader();

PageBuilder::addComponent("home", "default");

$page->buildFooter();
?>