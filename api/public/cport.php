<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

#!$auth->isAuthed() && Server::_404();

if ($_SERVER["HTTP_USER_AGENT"] !== "Boomblox/1.0") {
    Server::_404();
}

if (isset($_GET["issue"])) {
    $thing = $_GET["issue"];
    Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to exploit, clue: $thing");
    exit;
} elseif (isset($_GET["dllissue"])) {
    $issue = $_GET["dllissue"];
    
    if (isset($_GET["module"])) {
        $module = $_GET["module"];
        str_replace("@", "", $module);
        switch ($issue) {
            case "Unauth":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to start the client with unauthorized module in folder: $module");
                break;
            case "NewModule":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to exploit with: $module");
                break;
            case "ManualMap":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to manual map and exploit with: $module");
                break;
            case "UnsignedSystem":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to load client with unsigned system dll: $module");
                break;
            case "BadHash":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to load client with a bad hash for dll: $module");
                break;
            case "SuspiciousSystemDll":
            case "UnknownModule":
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} tried to load client with an unknown dll: $module");
                break;
            default:
                Discord::sendWebhookMessage("anticheat", "{$user->getUsername()} did something that the anticheat cannot identify properly.");
                break;
        }
        
        exit;
    }
}
?>