<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;

#global $auth;
#!$auth->isAuthed() && Server::_404();
$is2007 = isset($_GET["2007"]);
?>

<?php if ($is2007): ?>
<button onclick="alert(window.external.IsRobloxIDE)">IsRobloxIDE</button>
<button onclick="window.external.GetApp().CreateGame(2)">Open game</button>
<button onclick="window.external.GetApp().CreateGame(2).ExecUrlScript('http://<?=domain?>/game/gameserver.ashx?2007=5')">Host game</button>
<button onclick="window.external.GetApp().CreateGame(2).ExecUrlScript('http://<?=domain?>/game/join.ashx?2007=7')">Join game</button>
<?php else: ?>
<button onclick="alert(window.external.IsRobloxAppIDE)">IsRobloxAppIDE</button>
<button onclick="window.external.GetApp().CreateGame('44340105256').ExecScript('loadfile(\'http://xoblog.dev/IDE/TestScript.ashx\')()')">test script</button>
<button onclick="window.external.GetApp().CreateGame('44340105256').ExecScript('dofile(\'http://xoblog.dev/game/join.ashx\')')">test join</button>
<button onclick="window.external.GetApp().CreateGame('44340105256').ExecUrlScript('http://<?=domain?>/game/gameserver.ashx?t=1')">test server</button>
<?php endif; ?>