<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$isWhitelisted = IP::whitelisted(IP::get());
if ($isWhitelisted !== false) {
    $user = new User($isWhitelisted);
    $username = $user->getUsername();
    Discord::sendWebhookMessage("weird", "$username is trying to access /wordpress/wp-admin/setup-config.php");
} else {
    Discord::sendWebhookMessage("weird", "Someone not whitelisted is trying to access /wordpress/wp-admin/setup-config.php");
}

Server::_404();
?>