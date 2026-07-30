<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$friendInvitation = new FriendInvitationManager;

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, '/templates/authheader.php', null, 'csettings');
$page->buildHeader();
$friendInvitation->load();
$page->buildFooter();
?>