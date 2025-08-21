<?php
#made: 03/30/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$bc = new MembershipManager($theme);

$page = new PageBuilder(Site::getThemeProperty("alias", $theme)." - ".Site::getThemeProperty("membership", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();
$bc->load();
$page->buildFooter();
?>