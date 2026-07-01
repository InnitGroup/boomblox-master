<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url")), 0, "/templates/dryheader.php", [], ["register"]);
$page->buildHeader();
PageBuilder::addComponent("newage", "default");
$page->buildFooter();