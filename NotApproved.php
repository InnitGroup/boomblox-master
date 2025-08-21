<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");
!$user->isPunished() && header("Location: /Default.aspx");

if (Server::isPost()) {
    if (isset($_POST['ctl00$robloxCph$Reactivate']) && isset($_POST['ctl00$robloxCph$Agreement'])) {
        $punishment = $user->getActivePunishment();
        $length = $punishment["actionLength"];
        $datetime = new DateTime($punishment["actionDate"]);
        $expirestime = $datetime->modify("+$length day");
        $todaytime = new DateTime();
        if ($todaytime >= $expirestime) {
            $stmt = "UPDATE moderation SET actionActive=0 WHERE id=:id";
            $db->execute($stmt, [":id" => $punishment["id"]]);
            header("Location: /Default.aspx");
        }
    }
}

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." | Disabled Account", $theme, "/templates/dryheader.php");

$page->buildHeader();
PageBuilder::addComponent("notapproved", "main");
$page->buildFooter();
?>