<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404(); #

$groupId = isset($_GET["ForumGroupID"]) ? (int)$_GET["ForumGroupID"] : Server::_404();
$group = new ForumGroup($groupId);

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], "rbxnews");
$page->buildHeader();
?>
<link rel="stylesheet" href="/Forum/skins/default/style/default.css">
<?php
PageBuilder::addComponent("forum", "showforumgroup");

$page->buildFooter();
?>