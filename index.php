<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth;

$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["Super"])) {
    if ($_GET["Super"] === "Califragilistic") {
        header("Location: /Login/Default.aspx?Expialo=docious");
        exit;
    }
}

if (isset($_GET["IDont"])) {
    if ($_GET["IDont"] === "SeeMyself") {
        header("Location: /Login/NewAge.aspx?Upon=ThatList");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
