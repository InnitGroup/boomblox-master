<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

Server::ipLock();

$userId = $_GET["userid"] ?? NULL;
$key = $_GET["key"] ?? NULL;
$assetId = isset($_GET["assetnumber"]) ? (int)$_GET["assetnumber"] : Server::_404();

switch ($key) {
    # this has been here since jan 2025, unused
    /* case "Apostles":
    */

    # october 1st, 2025 - yorick's resting place event (DEFUNC)
    case "H3d1dTh3M0nst3rM4sh":
        break;

        if (!$db->userExists($userId)) {
            break;
        }

        if ($assetId !== 977) {
            break;
        }

        $user = new User($userId);
        $user->giveItem($assetId);
        Discord::sendWebhookMessage("weird", "{$user->getUsername()} received The Riddling Skull !");
        break;

    case "IR34l1yL0v3Th3RustyT3tr4m1n0H4h4h4h444444":
        $assetIds = [];

        if (!$db->userExists($userId)) {
            break;
        }

        if (!in_array($assetId, $assetIds)) {
            break;
        }

        $user = new User($userId);
        $user->giveItem($assetId);
        Discord::sendWebhookMessage("weird", "{$user->getUsername()} received [$assetId](https://".url."/Item.aspx?ID=$assetId) !");
        break;
    }
?>