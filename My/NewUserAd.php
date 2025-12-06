<?php
#made: 03/15/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!AdManager::isWhitelisted() && Server::_404();

$ad = new AdManager;

if (Server::isPost()) {
    $upload = $ad->handleUpload();
    if (isset($upload->Error)) {
        echo $upload->Error;
    }
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "edititem"); # 
$page->setImageForm();
$page->buildHeader();

PageBuilder::addComponent("userad", "newad");

$page->buildFooter();
?>