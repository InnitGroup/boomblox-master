<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
if (!isset($_GET["PlaceID"]) || !isset($_GET["TypeID"])) {
    Client::clearType($user->getUserId());
    Server::_404();
}

Client::clearType($user->getUserId());

$placeId = $_GET["PlaceID"];
$typeId = $_GET["TypeID"] ?? 0;
$serverId = isset($_GET["ServerID"]) && !empty($_GET["ServerID"]) ? (int)$_GET["ServerID"] : 0;
$type;

switch ($typeId) {
    case 1:
        $type = "join";
        break;
    case 2:
        $type = "visit";
        break;
    case 3:
        $type = "edit";
        break;
}
?>

<script>
    function join(placeId, serverId) {
        <?php if ($type != "join"): ?>
        var visitUrl = "http://<?=domain?>/Game/<?=$type?>.ashx?PlaceID="+placeId;
        <?php elseif ($type == "join"): ?>
        var visitUrl = "http://<?=domain?>/Game/join.ashx?PlaceID="+placeId+"&ServerID="+serverId;
        <?php endif; ?>

        try {
            var app = window.external.GetApp();
            var workspace = app.CreateGame('44340105256'); // 44340105256
            workspace.ExecUrlScript(visitUrl);

            window.location = "http://<?=domain?>/Games.aspx";
        } catch (error) {
            document.write("COM is not installed on this Roblox client, locate the client folder and run <b>RobloxApp.exe /regserver</b> in CMD to install COM: <br>" + error);
            alert(error);
        }
    }

    join(<?=$placeId?>, <?=$serverId?>);
</script>

<p>You're seeing this for 1 of 2 reasons:</p>
<ul>
    <li>You're currently loading into a game on the Boom - this can be a result for users with slower internet speeds</li>
    <li>Your client's COM is improperly installed - locate the client folder and run <b>RobloxApp.exe /regserver</b> in CMD to install COM</li>
    <li>Your Internet Explorer's javascript is disabled - please enable it</li>
</ul>
<br>
<button onclick="alert(window.external.IsRobloxAppIDE)">COM Tester</button>
<a href="/">Back home</a>