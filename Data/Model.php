<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;
$modelData = gzdecode(file_get_contents("php://input"));

$file = fopen($_SERVER["DOCUMENT_ROOT"]."/content/temp/".$user->getUserId(), "w");
fwrite($file, $modelData);
fclose($file);
?>