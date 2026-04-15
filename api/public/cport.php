<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

#!$auth->isAuthed() && Server::_404();

Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} test");

if ($_SERVER["HTTP_USER_AGENT"] !== "Boomblox/1.0") {
    Server::_404();
}

if (isset($_POST)) {
    $contents = file_get_contents("php://input");
    if (str_contains($contents, "@")) {
        $contents = str_replace("@", "[@]", $contents);
    }

    Discord::sendWebhookMessage("anticheat", "{$user->getUsername()}'s client was found to contain $contents");
}
?>