<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->hasPerms(7) && Server::_404();

$manager = new TradeCurrencyManager;
$manager->controller();

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." is SAFE for kids! ROBLOX is a FREE casual virtual world with fully constructible/desctructible environments and immersive physics. Build, battle, chat, or just hang out.", $theme, "/templates/authheader.php", null, "economy");
$page->buildHeader();

$manager->viewer(); #

$page->buildFooter();
?>