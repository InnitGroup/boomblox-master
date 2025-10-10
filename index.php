<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["For"])) {
    if ($_GET["For"] === "TheFameWontYou") {
        header("Location: /Login/Default.aspx?I=ServeTheBase");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
