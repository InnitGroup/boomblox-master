<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;
$page->buildHeader();

PageBuilder::addComponent("economy", "ownership");

$page->buildFooter();
?>