<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["MoMoney"])) {
    if ($_GET["MoMoney"] === "MoProblems") {
        header("Location: /Login/Default.aspx?Big=E");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
