<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder("About " . Site::getThemeProperty("alias",$theme), $theme, "/templates/authheader.php");
$page->buildHeader();

if ($theme == 0 || $theme == 4) {
    PageBuilder::addComponent("info", "aboutboomblox");
} else {
    PageBuilder::addComponent("info", "about");
}

$page->buildFooter();
?>