<?php
#made: 03/15/2025 @marsoc
#last edit: 03/15/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." Error", $theme, "/templates/dryheader.php");
$page->buildHeader();

if (isset($_GET["aspxerrorpath"])) {
    $errorPath = "/".$_GET["aspxerrorpath"];
} else {
    $errorPath = "";
}

$errorId = $_GET["ID"];
PageBuilder::addComponent("error", "specific", compact("errorId"));

$page->buildFooter();
?>