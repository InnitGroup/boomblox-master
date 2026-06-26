<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth;

if (isset($_GET["WhenWill"])) {
    if ($_GET["WhenWill"] === "YouLearn") {
        echo '<img style="display:block;margin-left:auto;margin-right:auto;margin-top:250px" src="/images/supernichelogoahhahah.png">';
        exit;
    }
}

$auth->isAuthed() && header("Location: /Default.aspx") && exit;

if (isset($_GET["XO"])) {
    if ($_GET["XO"] === "TourLlif3") {
        header("Location: /Login/Default.aspx?Luv=IsRage2");
        exit;
    }
}

PageBuilder::addComponent("outside", "index");
exit;
?>
