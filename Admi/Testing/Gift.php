<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();

$page = new APageBuilder;
$page->buildHeader();

PageBuilder::addComponent("admin", "gift");

$page->buildFooter();
?>