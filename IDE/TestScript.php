<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-type: text/plain");

global $theme, $auth, $user;

global $auth;
!$auth->isAuthed() && Server::_404();

echo Crypt::scriptSign(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/api/private/lua/test.lua"));
?>