<?php
#made: 03/15/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$placeId = $_GET["ID"] ?? 0;
$post = $_POST;

$place = new PlaceManager($post, $theme, $placeId);

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", null, "myplace"); # 
$page->buildHeader();

$place->load();

$page->buildFooter();
?>