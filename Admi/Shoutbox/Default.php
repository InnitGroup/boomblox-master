<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$shoutbox = new ShoutboxManager;
$page = new APageBuilder;
$page->buildHeader();

$shoutbox->load();

$page->buildFooter();
?>