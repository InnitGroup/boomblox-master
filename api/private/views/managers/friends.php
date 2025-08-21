<?php

class FriendsManager {
    private int $userId;
    public function __construct() {
        global $db;
        if (!$db->userExists($_GET["UserID"])) {
            Server::_404();
        }
        $this->userId = (int)$_GET["UserID"];
    }
    public function load() {
        $user = new User($this->userId);
        PageBuilder::addComponent("friends", "main", compact("user"));
    }
}

?>