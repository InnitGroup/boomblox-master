<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contents = file_get_contents("php://input");
    str_replace("@", $contents, "A");

    Discord::sendWebhookMessage("vcchat", $contents);
}
?>