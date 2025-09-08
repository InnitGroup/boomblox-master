<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

!$user->hasPerms(3) && Server::_404();

$page = new PageBuilder(Site::getThemeProperty("alias",$theme).": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics", $theme, "/templates/authheader.php", [], "rbxnews");
$page->buildHeader();
?>
<?php
PageBuilder::addComponent("forum", "default");

$page->buildFooter();
?>