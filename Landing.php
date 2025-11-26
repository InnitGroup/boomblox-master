<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;

global $auth;
!$auth->isAuthed() && Server::_404();

#https://www.youtube.com/watch?v=Z6yYyWw79Ew
header("Location: /Games.aspx");
exit;
?>