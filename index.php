<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
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
