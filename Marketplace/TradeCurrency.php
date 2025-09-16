<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Default.aspx");

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." is SAFE for kids! ROBLOX is a FREE casual virtual world with fully constructible/desctructible environments and immersive physics. Build, battle, chat, or just hang out.", $theme, "/templates/authheader.php", null, "economy");
$page->buildHeader();

PageBuilder::addComponent("marketplace", "tradecurrency");

$page->buildFooter();
?>