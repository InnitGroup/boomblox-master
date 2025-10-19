<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

Discord::sendWebhookMessage("weird", "a" . file_get_contents("php://input"));
?>