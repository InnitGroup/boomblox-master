<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;
#file_put_contents($_SERVER["DOCUMENT_ROOT"]."/Game/test.txt", file_get_contents("php://input"));

$banned = ["poopy doopy22"];
$context = file_get_contents("php://input");

if (in_array($context, $banned)) {
    echo "False";
    exit;
}

echo "True";
exit;
?>