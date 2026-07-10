<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$user->isTester() && Server::_404();

if (Server::isPost()) {
    if (isset($_POST['ctl00$RobloxGroup$Purchase'])) {
        $name = Helper::debugString($_POST['ctl00$RobloxGroup$Name']);
        $desc = Helper::debugString($_POST['ctl00$RobloxGroup$Description']);
        $privacy = (int)$_POST['ctl00$RobloxGroup$Settings$GroupEntry'];
        $wallView = (int)$_POST['ctl00$RobloxGroup$Settings$WallView'];
        $posting = (int)$_POST['ctl00$RobloxGroup$Settings$Posting'];
        $emblem = 5879;

        if (strlen($name) > 50) return;
        if (strlen($desc) > 500) return;
        if (($privacy > 2 || $wallView > 2 || $posting > 2) || ($privacy < 1 || $wallView < 1 || $posting < 1)) return;
        if ($user->ownedGroups() > 3) return;

        Group::new($name, $desc, $emblem, $privacy, $wallView, $posting);
    }
}

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url", $theme)), 6, "2010header");
$page->buildHeader();
PageBuilder::addComponent("groups", "create");
$page->buildFooter();
?>