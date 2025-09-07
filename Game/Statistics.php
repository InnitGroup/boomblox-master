<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $db;

$type = $_GET["TypeID"] ?? 0;
$user = $_GET["UserID"] ?? NULL;
$associate = $_GET["AssociatedUserID"] ?? NULL;
$place = $_GET["AssociatedPlaceID"] ?? NULL;
$serverPort = $_GET["serverPort"] ?? NULL;

if ((int)$type !== 3) {
    Server::ipLock();
}

switch ($type) {
    case 1:
        #player join
        if (!isset($associate)) {
            echo "bad";
            exit;
        }

        if (!isset($serverPort)) {
            echo "bad";
            exit;
        }

        if (!isset($_GET["ClientTicket"])) {
            echo "bad";
            exit;
        }

        if (!Gameservers::serverExists($serverPort)) {
            echo "bad";
            exit;
        }

        $clientTicket = $_GET["ClientTicket"];
        $player = new User($associate);

        if ($player->getTicket() !== $clientTicket) {
            echo "bad";
            exit;
        }

        $stmt = "SELECT playerTable FROM servers WHERE port=:serverPort";
        $result = $db->execute($stmt, [":serverPort" => $serverPort]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $playerTable = unserialize($fetched["playerTable"]);

        array_push($playerTable, (int)$associate);
        $playerTable = serialize($playerTable);

        $stmt = "UPDATE servers SET playerTable = :playerTable, players = players + 1 WHERE port=:serverPort";
        $db->execute($stmt, [
            ":playerTable" => $playerTable,
            ":serverPort" => $serverPort
        ]);

        $stmt = "SELECT creatorId FROM items WHERE itemId=:placeId";
        $result = $db->execute($stmt, [":placeId" => $place]);
        $creatorId = $result->fetch(PDO::FETCH_ASSOC);
        $creatorId = $creatorId["creatorId"];

        if (!$player->ownsPlace($place)) {
            $stmt = "UPDATE items SET interactions = interactions + 1 WHERE itemId=:placeId";
            $db->execute($stmt, [":placeId" => $place]);
            $stmt = "UPDATE users SET tix = tix + 1 WHERE id=:userId";
            $db->execute($stmt, [":userId" => $creatorId]);
        }

        Discord::sendWebhookMessage("join", $player->getUsername() .. " joined [place $place](https://xoblog.dev/Item.aspx?ID=$place)")

        echo $player->getCharacterAppearance();
        
        break;
    case 2:
        #player leave
        if (!isset($associate)) {
            exit;
        }

        if (!isset($serverPort)) {
            exit;
        }

        $associate = (int)$associate;
        $stmt = "SELECT * FROM servers WHERE port=:serverPort";
        $result = $db->execute($stmt, [":serverPort" => $serverPort]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $playerTable = unserialize($fetched["playerTable"]);

        if ($fetched["players"] > 0) {
            $key = array_search($associate, $playerTable);
            unset($playerTable[$key]);

            $playerTable = serialize($playerTable);
        
            $stmt = "UPDATE servers SET playerTable = :playerTable, players = players - 1 WHERE port=:serverPort";
            $db->execute($stmt, [
                ":playerTable" => $playerTable,
                ":serverPort" => $serverPort
            ]);
        }

        break;
    case 3:
        #update clientjoin
        if (!$db->userExists($user)) {
            break;
        }
        
        $stmt = "UPDATE users SET clientjoin=0 WHERE id=:userId";
        $db->execute($stmt, [":userId" => $user]);
        break;
    case 15:
        #kill
        if (isset($_GET["Key"])) {
            if ($_GET["Key"] == "AWESOME1SAUCE") {
                $stmt = "UPDATE users SET kos = kos + 1 WHERE id=:userId";
                $db->execute($stmt, [":userId" => $user]);
                $user = new User($user);
                $user->giveTix(2);
            }
        }
        break;
    case 16:
        #death
        if (isset($_GET["Key"])) {
            if ($_GET["Key"] == "SUPER1SADGRRR") {
                $stmt = "UPDATE users SET kos = kos + 1 WHERE id=:userId";
                $db->execute($stmt, [":userId" => $user]);
            }
        }
        break;
}
?>