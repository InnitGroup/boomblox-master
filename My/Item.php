<?php
#made: 03/15/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$editItem = new EditItemManager;

if (Server::isPost()) {
    $handler = $editItem->handle();
}

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], "edititem"); # 
$page->buildHeader();

$editItem->load();

$page->buildFooter();
?>