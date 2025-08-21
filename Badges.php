<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new PageBuilder(Site::getThemeProperty("alias", $theme) . " | Badges", $theme, "/templates/authheader.php", null, "badges");
$page->buildHeader();

PageBuilder::addComponent("badges", "main");

$page->buildFooter();