<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!isset($_GET["adId"]) && Server::_404();

$manager = new AdManager;

if (Server::isPost()) {
    $manager->adBuy();
}

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], "edititem"); # 
$page->buildHeader();

PageBuilder::addComponent("userad", "buy");

$page->buildFooter();
?>