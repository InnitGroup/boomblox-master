<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["Ill"])) {
    if ($_GET["Ill"] === "HaveToPackMyThingsAndGo") {
        header("Location: /Login/Default.aspx?Hit=TheRoadJack");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
?>
