<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

Server::ipLock();

$userId = $_GET["userid"] ?? NULL;
$key = $_GET["key"] ?? NULL;
$assetId = isset($_GET["assetnumber"]) ? (int)$_GET["assetnumber"] : NULL;

switch ($key) {
    # this has been here since jan 2025, unused
    /* case "Apostles":
    */

    # october 1st, 2025 - yorick's resting place event
    case "H3d1dTh3M0nst3rM4sh":
        #977
        if (!$db->userExists($userId)) {
            break;
        }

        if ($assetId !== 977) {
            break;
        }

        $user = new User($userId);
        $user->giveItem($assetId, false);
        break;
}
?>