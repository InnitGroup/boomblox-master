<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $db;
if (Server::getIP() !== Server::getServerIP()) {
    Server::_404();
}

#exit;

# check if there are any servers being queued
$stmt = "SELECT * FROM servers WHERE active=0 ORDER BY id ASC";
$result = $db->execute($stmt);
if ($result->rowCount() == 0) exit;
echo 1;

# load up the oldest-queued server
$server = $result->fetch(PDO::FETCH_ASSOC);

# ?serverPort=" . $port . "&PlaceID=".$placeId."
?>

<head>
    <!--<meta http-equiv="refresh" content="1">-->
    <script>
        window.external.GetApp().CreateGame(0).ExecUrlScript("http://<?=domain?>/game/gameserver.ashx?serverPort=<?=$server["port"]?>&PlaceID=<?=$server["placeId"]?>&2007=1");
    </script>
</head>