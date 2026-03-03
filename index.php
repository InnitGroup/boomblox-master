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

if (isset($_GET["Play"])) {
    if ($_GET["Play"] === "ThatSong") {
        header("Location: /Login/Default.aspx?Thats=AllYouGotToDo");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
