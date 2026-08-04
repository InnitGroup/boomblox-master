<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404();

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();

if (isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword2']) || isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$SearchKeyword']) || isset($_POST['PageTracker'])) {
    PageBuilder::addComponent("groups", "indexed");
} else {
    PageBuilder::addComponent("groups", "search");
}

$page->buildFooter();
?>