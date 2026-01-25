<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user, $db;
!$auth->isAuthed() && Server::_404();

echo AssetRedirect::breaksTimeline(1097026);
?>