<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;
$page->buildHeader();

PageBuilder::addComponent("grid", "manage");

$page->buildFooter();
?>