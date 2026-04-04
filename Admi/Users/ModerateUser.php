<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();
!$auth->hasPerms(3) && Server::_404();
!isset($_GET["UserID"]) && Server::_404();
!$db->userExists($_GET["UserID"]) && Server::_404();
$moderatedUser = new User($_GET["UserID"]);

$error = "";

if (Server::isPost()) {
    # handle ban
    if (isset($_POST['ctl00$cphRoblox$OverrideAccountStateButton']) && isset($_POST['ctl00$cphRoblox$PunishmentOptionsRadioButtonList']) && isset($_POST['ctl00$cphRoblox$AccountStateMessageToUserTextBox']) && isset($_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox'])) {
        if (!empty($_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox']) && !empty($_POST['ctl00$cphRoblox$AccountStateMessageToUserTextBox'])) {
            $punishmentId = $_POST['ctl00$cphRoblox$PunishmentOptionsRadioButtonList'];
            if ($punishmentId > 6 && !$user->hasPerms(6)) {
                $error = "You do not have permission to perform this action.";
            }

            if ($punishmentId > 6 && !$user->hasPerms(6)) {
                $error = "You do not have permission to perform this action.";
            }
            
            if (empty($error)) {  
                $note = $_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox'];
                $message = $_POST['ctl00$cphRoblox$AccountStateMessageToUserTextBox'];
                $length = Admin::getPunishmentLengthFromId($punishmentId) ?? 0;

                if (isset(Admin::getPunishmentsArray()[$punishmentId]) || $punishmentId == 1) {
                    $moderatedUser->punish($punishmentId, $length, $note, $message);

                    if (isset($_GET["AbuseID"])) {
                        global $db;
                        $stmt = "SELECT * FROM reports WHERE id=:abuseId";
                        $abuseId = $_GET["AbuseID"];
                        $result = $db->execute($stmt, [":abuseId" => $abuseId]);

                        if ($result->rowCount() > 0) {
                            $report = $result->fetch(PDO::FETCH_ASSOC);
                            
                            if ($report["type"] == "user") {
                                if ($_GET["UserID"] == $report["abuse"]) {
                                    $stmt = "UPDATE reports SET handled=1 WHERE id=:abuseId";
                                    $db->execute($stmt, [":abuseId" => $abuseId]);
                                }
                            } elseif ($report["type"] == "asset") {
                                $stmt = "UPDATE reports SET handled=1 WHERE id=:abuseId";
                                $db->execute($stmt, [":abuseId" => $abuseId]);
                            }
                        }
                    }
                } else {
                    $error = "You must choose a valid punishment.";
                }
            }
        } else {
            $error = "You must send a moderation note and a message for the user.";
        }
    }

    # bc handler
    if (isset($_POST['ctl00$cphRoblox$AddMembershipButton'])) {
        
    }
}

# ["ctl00$cphRoblox$PunishmentOptionsRadioButtonList"]=> string(1) "8" ["ctl00$cphRoblox$AccountStateModerationNoteTextBox"]=> string(0) "" ["ctl00$cphRoblox$AccountStateMessageToUserTextBox"]=> string(0) "" ["ctl00$cphRoblox$OverrideAccountStateButton"]=> string(6) "Submit"
 
$page = new APageBuilder;
$page->buildHeader();

PageBuilder::addComponent("admin", "moderateuser", compact("moderatedUser", "error"));

$page->buildFooter();
?>