<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

exit;
$rccPort = 80;#Server::getRccPort();
$cmd = "netstat -aon | findstr :" . $rccPort;
$result = shell_exec($cmd);
print_r( $result );

?>