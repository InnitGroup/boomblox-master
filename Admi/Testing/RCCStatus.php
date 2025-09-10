<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;

exit;
$rccPort = 80;#Server::getRccPort();
$cmd = "netstat -aon | findstr :" . $rccPort;
$result = shell_exec($cmd);
print_r( $result );

?>