<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["I"])) {
    if ($_GET["I"] === "DidIt") {
        header("Location: /Login/Default.aspx?My=Way");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
