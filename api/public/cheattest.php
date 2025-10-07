<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
exit;
global $user, $auth;
!$auth->isAuthed() && Server::_404();
$thing = $_GET["issue"];
Discord::sendWebhookMessage("weird", "{$user->getUsername()} tried to exploit, clue: $thing");
echo 1;
?>