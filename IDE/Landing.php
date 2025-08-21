<?php
#made: 04/06/2025 @marsoc
#last edit: 04/06/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;

if (Client::getJoin()) {
    $clientJoin = Client::getJoin();
    $clientType = Client::getType();
    $server = Client::getServer();
    // add server parameter
    header("Location: /IDE/Game.aspx?PlaceID=" . $clientJoin . "&TypeID=" . $clientType . "&ServerID=" . $server);
} else {
    #https://www.youtube.com/watch?v=Z6yYyWw79Ew
    header("Location: /Games.aspx");
}

?>