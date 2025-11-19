<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;

global $auth;
!$auth->isAuthed() && Server::_404();
?>

<button onclick="alert(window.external.IsRobloxAppIDE)">IsRobloxAppIDE</button>
<button onclick="window.external.GetApp().CreateGame('44340105256')">CreateGame</button>
<button onclick="window.external.GetApp().CreateGame('44340105256').ExecUrlScript('http://xoblog.dev/IDE/test.lua')">CreateGame</button>