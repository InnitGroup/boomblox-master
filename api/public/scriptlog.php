<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contents = file_get_contents("php://input");
    Discord::sendWebhookMessage("weird", "Script from: {$user->getUsername()}: $contents");
}
   
?>