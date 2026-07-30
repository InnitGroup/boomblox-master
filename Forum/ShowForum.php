<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404(); #

$forumId = isset($_GET["ForumID"]) ? (int)$_GET["ForumID"] : Server::_404();
$forum = new Forum($forumId);

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], "rbxnews");
$page->buildHeader();
?>
<link rel="stylesheet" href="/Forum/skins/default/style/default.css">
<?php
PageBuilder::addComponent("forum", "showforum");

$page->buildFooter();
?>