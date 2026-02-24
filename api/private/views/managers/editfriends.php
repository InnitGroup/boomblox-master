<?php
class EditFriendsManager {
    public function __construct() {
        global $user;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['ctl00$cphRoblox$rbxEditFriendsPane$dlFriends$ctl00$bDelete'])) {
                $delete = $_POST['ctl00$cphRoblox$rbxEditFriendsPane$dlFriends$ctl00$bDelete'];
                $exploded = explode("$", $delete);
                $userId = $exploded[3];

                $friend = new User($userId);

                $user->removeFriend($friend->getUsername());
                $friend->removeFriend($user->getUsername());
            }
        }
    }
    public function load() {
        global $user;
        PageBuilder::addComponent("editfriends", "main", compact("user"));
    }
}
?>