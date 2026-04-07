<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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

    # december 16th, 2025 - rotris event
    case "IR34l1yL0v3Th3RustyT3tr4m1n0H4h4h4h444444":
        $assetIds = [365, 1672, 1673, 1674];

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
    case "WhyY0uG0tt4UpNJ1ckl3Y4ng":
        $assetIds = [3349, 12345678];

        if (!$db->userExists($userId)) {
            break;
        }

        if (!in_array($assetId, $assetIds)) {
            break;
        }

        $user = new User($userId);

        if ($assetId == 12345678) {
            $tix = 1;
            $user->giveTix($tix);
            Discord::sendWebhookMessage("weird", "{$user->getUsername()} received $tix tix from the Ticket Egg !");
            break;
        }

        $user->giveItem($assetId);
        Discord::sendWebhookMessage("weird", "{$user->getUsername()} received [$assetId](https://".url."/Item.aspx?ID=$assetId) !");
        
        break;
    }
?>