<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && header("Location: /Default.aspx");

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." is SAFE for kids! ROBLOX is a FREE casual virtual world with fully constructible/desctructible environments and immersive physics. Build, battle, chat, or just hang out.", $theme, "/templates/dryheader.php");
$page->buildHeader();
#https://www.youtube.com/watch?v=8L2AHsO3Hd0
$reset = new ResetPasswordRequest($_POST);
$reset->load();
$page->buildFooter();
?>