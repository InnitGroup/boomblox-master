<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["What"])) {
    if ($_GET["What"] === "IsLove") {
        header("Location: /Login/Default.aspx?Baby=DontHurtMe");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
