<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Discord::sendWebhookMessage("test", "this came from roblox com, user that launched it: {$user->getUsername()}");
}

exit;
?>