<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404();

$gid = (int)$_GET["gid"];
!Group::exists($gid) && Server::_404();

if (Server::isPost()) {
    
    $group = new Group($gid);
    if (isset($_POST['ctl00$cphRoblox$JoinGroup'])) {
        $group->addMember($user->getUserId());
    } elseif (isset($_POST['ctl00$cphRoblox$LeaveGroup'])) {
        $group->kickMember($user->getUserId());
    } elseif (isset($_POST['ctl00$GroupWall$Post'])) {
		$content = $_POST['ctl00$GroupWall$Text'];
		$group->addPost($content);
	}
    
    exit(header("Location: /Groups/Group.aspx?gid=$gid"));
}

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url", $theme)), 6, "2010header");
$page->buildHeader();
PageBuilder::addComponent("groups", "group");
$page->buildFooter();
?>