<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;

$stmt = "SELECT * FROM settings";
$result = $db->execute($stmt);
$page->buildHeader();

PageBuilder::addComponent("bayesian", "default", compact("result"));

$page->buildFooter();
?>