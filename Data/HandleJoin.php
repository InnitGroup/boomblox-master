<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $db, $auth;
!$auth->isAuthed() && Server::_404();

$userId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
$placeId = $_GET["PlaceID"];
$typeId = $_GET["TypeID"]; # 1 visit online | 2 visit solo | 3 edit
$serverId = 0;

if (Setting::disabled("Gameservers") && $typeId == 1) {
    $stmt = "UPDATE users SET serverjoin=:serverId, clientjoin=:placeId, clienttype=:typeId WHERE id=:userId";
    $db->execute($stmt, [
        ":serverId" => $serverId, 
        ":placeId" => $_GET["PlaceID"], 
        ":typeId" => $typeId, 
        ":userId" => $userId
    ]);
    header("Location: /Item.aspx?ID=".$_GET["PlaceID"]."&Refer=Disabled");
    exit;
}

if ($typeId == 1) {
    $serverId = isset($_GET["ServerID"]) ? $_GET["ServerID"] : 0;
    if (!Gameservers::getServerById($serverId)) {
        $serverPort = Gameservers::newServer($placeId);
        if (gettype($serverPort) !== "int") {
            echo $serverPort;
        }
        
        $server = Gameservers::getServerByPort($serverPort);
        $serverId = $server["id"];
    }
}

$stmt = "UPDATE users SET serverjoin=:serverId, clientjoin=:placeId, clienttype=:typeId WHERE id=:userId";
$db->execute($stmt, [
    ":serverId" => $serverId, 
    ":placeId" => $_GET["PlaceID"], 
    ":typeId" => $typeId, 
    ":userId" => $userId
]);

if (Server::isIE7()) {
    $user->setClientMd5(Server::currentClientMd5());
    exit(header("Location: /IDE/Landing.aspx"));
}

exit(header("Location: /Item.aspx?ID=".$_GET["PlaceID"]."&Refer=Uri"));

# make it so that if ServerID is defined, it will set it
?>