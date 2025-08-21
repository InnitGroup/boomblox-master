<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

if (isset($_GET["Type"])) {
    $type = $_GET["Type"];
} elseif (isset($_GET["type"])) {
    $type = $_GET["type"];
}

switch ($type) {
    case "Model":
        PageBuilder::addComponent("ide","modelupload");
        break;
    default:
        break;
}
?>