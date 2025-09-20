<?php
#made: 03/15/2025 @marsoc
#last edit: 03/15/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$inbox = new InboxManager;
if (isset($_POST)) {
    if (!empty($_POST)) {
        $inbox->handlePost();
    }
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." - Inbox", $theme, '/templates/authheader.php', null, 'inbox');
$page->buildHeader();
$inbox->load();
$page->buildFooter();
?>