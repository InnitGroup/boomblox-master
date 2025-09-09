<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["Hey"])) {
    if ($_GET["Hey"] === "IJustMetYou") {
        header("Location: /Login/Default.aspx?And=ThisIsCrazy");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
?>
