<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
#global $user, $auth;

Discord::sendWebhookMessage("anticheat", "user: `{$user->getUsername()}`, client md5: `" . $_GET["md5"] . "`");

exit;
?>