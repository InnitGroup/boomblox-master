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
    } elseif (isset($_POST['ctl00$cphRoblox$ClaimGroup'])) {
        $group->makeOwner($user->getUserId());
    } elseif (isset($_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$GroupWallPane$NewPostButton_x'])) {
		$content = $_POST['ctl00$ctl00$cphRoblox$cphMyRobloxContent$GroupWallPane$NewPost'];
		$group->addPost($content);
	} elseif (isset($_POST['ctl00$cphRoblox$GroupAdmin'])) {
        if ($group->getRolesetId($user->getUserId()) !== 0) {return;}
        exit(header("Location: /Groups/GroupAdmin.aspx?gid=$gid"));
    }
    
    exit(header("Location: /Groups/Group.aspx?gid=$gid"));
}

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url", $theme)), 6, "2010header");
$page->buildHeader();
PageBuilder::addComponent("groups", "group");
$page->buildFooter();
?>