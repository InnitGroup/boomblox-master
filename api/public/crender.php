<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$key = isset($_GET["key"]) ? $_GET["key"] : Server::_404();

if ($key == "Perfect") {
    $data = file_get_contents("php://input");
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/api/public/a.png", $data);
}
?>