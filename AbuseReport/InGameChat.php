<?php
#made: 02/26/2025 @marsoc
#last edit: 02/26/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

if (Server::isPost()) {
    if (isset($_POST['ctl00$cphRoblox$ReportReason'])) {
        PageBuilder::addComponent("report", "chatsuccess");
        
        global $db;
        if (!$db->userExists((int)$_POST['ctl00$robloxCph$reportedUser'])) {
            exit;
        }

        $stmt = "INSERT INTO reports (`type`, `abuse`, `comment`, `reportedBy`, `date`) VALUES ('user', :abuse, :comment, :reportedBy, :reportTime)";
        $db->execute($stmt, [
            ":abuse" => (int)$_POST['ctl00$robloxCph$reportedUser'],
            ":comment" => $_POST['ctl00$cphRoblox$ReportReason'],
            ":reportedBy" => $user->getUserId(),
            ":reportTime" => date("Y-m-d H:i:s")
        ]);
        
    } elseif (isset($_POST['ctl00$robloxCph$reportedUser'])) {
        PageBuilder::addComponent("report", "chatreason");
    }
    
} else {
    PageBuilder::addComponent("report", "chatinitial");
}
?>