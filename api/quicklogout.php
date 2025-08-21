<?php
#made: 01/09/2025 @marsoc
#last edit: 01/10/2025 @marsoc: api now returns user to welcome page after logout()
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$auth->logout();
header("Location: /Welcome.php");

?>