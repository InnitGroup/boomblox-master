<?php
class EditFriendsManager {
    public function __construct() {
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['ctl00$cphRoblox$rbxEditFriendsPane$dlFriends$ctl00$bDelete'])) {
                $delete = $_POST['ctl00$cphRoblox$rbxEditFriendsPane$dlFriends$ctl00$bDelete'];
                $exploded = explode("$", $delete);
                $userId = $exploded[3];

                $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
                $friend = new User($userId);

                $user->removeFriend($friend->getUsername());
                $friend->removeFriend($user->getUsername());
            }
        }
    }
    public function load() {
        $user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
        PageBuilder::addComponent("editfriends", "main", compact("user"));
    }
}
?>