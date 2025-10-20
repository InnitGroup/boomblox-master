<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php");
$page->buildHeader();
if ($theme == 0 || $theme == 4) {
    PageBuilder::addComponent("parents", "whattestersaresaying");
} else {
    PageBuilder::addComponent("parents", "whatparentsaresaying");
}

$page->buildFooter();
?>