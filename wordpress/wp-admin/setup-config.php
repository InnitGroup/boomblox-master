<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$isWhitelisted = IP::whitelisted(IP::get());
if ($isWhitelisted !== false) {
    $target = new User($isWhitelisted);
    $username = $target->getUsername();
    Discord::sendMessage(678343794101321728, ["content" => IP::get() . ": $username is trying to access /wordpress/wp-admin/setup-config.php"]);
    Discord::sendWebhookMessage("weird", "$username is trying to access /wordpress/wp-admin/setup-config.php");
} else {
    Discord::sendMessage(678343794101321728, ["content" => IP::get() . ": Someone not whitelisted is trying to access /wordpress/wp-admin/setup-config.php"]);
    Discord::sendWebhookMessage("weird", "Someone not whitelisted is trying to access /wordpress/wp-admin/setup-config.php");
}

Server::_404();
?>