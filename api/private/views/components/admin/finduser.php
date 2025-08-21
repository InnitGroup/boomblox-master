<?php
if (Server::isPost()) {
    global $db, $user;
    if (!empty($_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox'])) {
        $search = "username LIKE '" . htmlspecialchars($_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox']) . "%'";
        $username = $_POST['ctl00$cphRoblox$AccountStateModerationNoteTextBox'];
        $type = "username";
    } elseif (!empty($_POST['ctl01$cphRoblox$AccountStateModerationNoteTextBox'])) {
        $search = "id = " . (int)$_POST['ctl01$cphRoblox$AccountStateModerationNoteTextBox'];
        $userId = $_POST['ctl01$cphRoblox$AccountStateModerationNoteTextBox'];
        $type = "user ID";
    } elseif (!empty($_POST['ctl02$cphRoblox$AccountStateModerationNoteTextBox'])) {
        $search = "email = " . (int)$_POST['ctl02$cphRoblox$AccountStateModerationNoteTextBox'];
        $discordId = $_POST['ctl02$cphRoblox$AccountStateModerationNoteTextBox'];
        $type = "discord ID";
    }

    if (isset($search)) {
        if ($user->hasPerms(3)) {
            $stmt = "SELECT * FROM users WHERE " . $search;
            $result = $db->execute($stmt);
            if ($result->rowCount() > 0) {
                $users = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $error = "No user found with the given " . $type;
            }
        }
    } else {
        $error = "N/A";
    }
}
?>

<div id="MainPanel">
	<div>
		<p>Billing: Billing Search has been moved <a href="#">LINK</a>
		</p>
		<p>User Name: <input name="ctl00$cphRoblox$AccountStateModerationNoteTextBox" type="text" id="ctl00_cphRoblox_AccountStateModerationNoteTextBox" value="">&nbsp; <input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Search By Username" id="ctl00_cphRoblox_OverrideAccountStateButton">
		</p>
		<hr>
		<p>User ID: <input name="ctl01$cphRoblox$AccountStateModerationNoteTextBox" type="text" id="ctl01_cphRoblox_AccountStateModerationNoteTextBox" value="">&nbsp; <input type="submit" name="ctl01$cphRoblox$OverrideAccountStateButton" value="Search By User ID" id="ctl01_cphRoblox_OverrideAccountStateButton">
		</p>
		<hr>
		<p>Email Address: <input name="ctl02$cphRoblox$AccountStateModerationNoteTextBox" type="text" id="ctl02_cphRoblox_AccountStateModerationNoteTextBox" value="">&nbsp; <input type="submit" name="ctl02$cphRoblox$OverrideAccountStateButton" value="Search By Email Address" id="ctl02_cphRoblox_OverrideAccountStateButton">
		</p>
		<!-- marsoc, this is where the user search results will be shown - george0001 -->
		<?php
        if (Server::isPost()) { 
            if (isset($users)) {
                PageBuilder::addComponent("admin", "findusertable", compact("users"));
            } else {
                PageBuilder::addComponent("admin", "nousersfound", compact("error"));
            }
        } else {
            PageBuilder::addComponent("admin", "nousersfound");
        }
        ?>
	</div>
</div>