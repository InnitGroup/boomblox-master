<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$placeId = $_GET["PlaceID"];
$typeId = $_GET["TypeID"];
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

        var app = window.external.GetApp();
        var workspace = app.CreateGame(1);
        workspace.ExecUrlScript(visitUrl);

        window.location = "http://<?=domain?>/Games.aspx";
    }
    join(<?=$placeId?>, <?=$serverId?>);
</script>