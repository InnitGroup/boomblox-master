<?php
#made: 04/10/2025 @marsoc
#last edit: 04/10/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$csettings = new CSettingsManager($_POST, $theme);

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Custom Settings", $theme, '/templates/authheader.php', null, 'csettings');
$page->buildHeader();
$csettings->load();
$page->buildFooter();
?>