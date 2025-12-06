<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->hasPerms(7) && Server::_404();

!AdManager::isWhitelisted() && Server::_404();

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "edititem"); # 
$page->buildHeader();

PageBuilder::addComponent("userad", "inventory");

$page->buildFooter();
?>