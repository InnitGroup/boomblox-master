<?php
#made: 04/08/2025 @marsoc
#last edit: 04/08/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$key = $_GET["Key"];
if ($key !== "IWantToResetMyPasswordPlease") {
    Server::_404();
}

$reset = new ResetPassword($_POST, $_GET);
$page = new PageBuilder("Change Your " . Site::getThemeProperty("alias", $theme) . " Password", $theme, "/templates/dryheader.php");
$page->buildHeader();
$reset->load();
$page->buildFooter();
?>