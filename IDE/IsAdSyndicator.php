<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$site = $_GET["site"];
switch ($site) {
    case "www.youtube.com":
        return 1;
    default:
        return 0;
}
?>