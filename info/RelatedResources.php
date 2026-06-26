<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

$page = new PageBuilder("Related Resources", $theme, "/templates/authheader.php");
$page->buildHeader();

PageBuilder::addComponent("info", "relatedresources");

$page->buildFooter();
?>