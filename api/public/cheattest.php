<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

!$auth->isAuthed() && Server::_404();

if ($_SERVER["HTTP_USER_AGENT"] !== "Boomblox_/1.0") {
    Server::_404();
}

if (isset($_GET["issue"])) {
    $thing = $_GET["issue"];
    Discord::sendWebhookMessage("weird", "{$user->getUsername()} tried to exploit, clue: $thing");
    exit;
} elseif (isset($_GET["dllissue"])) {
    $issue = $_GET["dllissue"];
    if (isset($_GET["module"])) {
        $module = $_GET["module"];
        if ($issue == "Unauth") {
            Discord::sendWebhookMessage("weird", "{$user->getUsername()} tried to start the client with unauthorized module in folder: $module");
            exit;
        } elseif ($issue == "NewModule") {
            Discord::sendWebhookMessage("weird", "{$user->getUsername()} tried to exploit with: $module");
            exit;
        } elseif ($issue == "ManualMap") {
            Discord::sendWebhookMessage("weird", "{$user->getUsername()} tried to manual map and exploit with: $module");
            exit;
        }
    }
}
?>