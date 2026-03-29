<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
/*
if (!$auth->isAuthed()) {
    $log = implode(" -- ", $_SERVER);
    if (strpos($_SERVER["HTTP_USER_AGENT"], "Discordbot/2.0") !== false) {
        Discord::sendWebhookMessage("e", "Emergency log: discord embed from site");
    } else {
        Discord::sendWebhookMessage("e", "Emergency log: ```" . $log . "```");
    }
}
*/

$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["Every"])) {
    if ($_GET["Every"] === "Breath") {
        header("Location: /Login/Default.aspx?You=Take");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
