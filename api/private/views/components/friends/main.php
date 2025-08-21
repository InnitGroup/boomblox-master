<?php
$username = $user->getUsername();
$userId = $user->getUserId();

(object)$data = [
    "page" => 1,
    "userId" => $userId,
    "username" => $username,
];
?>

<div id="Body">
    <div id="FriendsContainer">
        <div id="Friends">
            <?=PageBuilder::addComponent("friends", "list", compact("username", "data"))?>
        </div>
    </div>
</div>