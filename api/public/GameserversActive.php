<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

echo (int)Setting::enabled("Gameservers");
?>