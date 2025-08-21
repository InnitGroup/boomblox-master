<?php
#made: 03/15/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$editItem = new EditItemManager;

if (Server::isPost()) {
    $handler = $editItem->handle();
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "edititem"); # 
$page->buildHeader();

$editItem->load();

$page->buildFooter();
?>