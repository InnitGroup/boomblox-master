<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
if ($auth->isAuthed()) {
    Client::setJoin($user->getUserId(), $_GET["PlaceID"]);
    exit;
}

Discord::sendWebhookMessage("weird", "Someone tried to set client ticket data, but wasn't authenticated");
?>