<?php
#made: 01/28/2025 @marsoc
#last edit: 02/05/2025 @marsoc: paginator fixes and sorts
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$sort = $_POST["__EVENTARGUMENT"] ?? "Page$1";
$search = $_POST["SearchTextBox"] ?? "";
$browse = new BrowseManager($sort, $search);

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();

$browse->load();

$page->buildFooter();
?>