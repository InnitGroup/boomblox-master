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
            Discord::sendWebhookMessage("weird", "User ID $associate tried to join a server without a port");
            exit;
        }

        if (!isset($_GET["ClientTicket"])) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Client ticket failed for User ID: $associate");
            exit;
        }

        if (!Gameservers::serverExists($serverPort)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "User ID $associate tried to join a non-existent server");
            exit;
        }

        if (!$db->userExists($associate)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to join $place with userId 0");
            exit;
        }

        $clientTicket = $_GET["ClientTicket"];
        $player = new User($associate);

        if ($player->getTicket() !== $clientTicket) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to join $place as " . $player->getUsername() . " but their client ticket didn't authenticate");
            exit;
        }

        $stmt = "SELECT playerTable FROM servers WHERE port=:serverPort";
        $result = $db->execute($stmt, [":serverPort" => $serverPort]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $playerTable = unserialize($fetched["playerTable"]);

        #if ($player->isGuest()) {
            #array_push($playerTable, 1);
        #} else {
            array_push($playerTable, (int)$associate);
        #}
        
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
            $creator = new User($creatorId);
            $creator->giveTix(1);
        }

        $stmt = "SELECT gears FROM items WHERE itemId=:placeId";
        $result = $db->execute($stmt, [":placeId" => $place]);
        $includeGears = $result->fetch(PDO::FETCH_ASSOC)["gears"];
        if ($includeGears == NULL) {$includeGears = serialize([]);}
        #Discord::sendWebhookMessage("games", $includeGears);

        if ($player->isGuest()) {
            $guestId = $player->guestId();
            Discord::sendWebhookMessage("games", $player->getUsername() . " joined [place $place](https://" . domain . "/Item.aspx?ID=$place) as Guest $guestId");
            Analytics::logJoin($player->getUserId(), $place);

            echo "http://" . domain . "/Asset/CharacterFetch.ashx?userId=1&IncludeGear=$includeGears";
            exit;
        }

        Discord::sendWebhookMessage("games", $player->getUsername() . " joined [place $place](https://" . domain . "/Item.aspx?ID=$place)");
        Analytics::logJoin($player->getUserId(), $place);

        echo "http://" . domain . "/Asset/CharacterFetch.ashx?userId=$associate&IncludeGear=$includeGears";
        
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

        if (!$db->userExists($associate)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to leave $place with userId 0");
            exit;
        }

        $player = new User($associate);
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

        Analytics::logLeave($player->getUserId(), $place);
        Discord::sendWebhookMessage("games", $player->getUsername() . " left");

        break;
    case 3:
        #update clientjoin
        if (!$db->userExists($user)) {
            Discord::sendWebhookMessage("weird", "Tried to update a users client ticket data with an ID of $user");
            break;
        }
        
        $stmt = "UPDATE users SET clientjoin=0 WHERE id=:userId";
        $db->execute($stmt, [":userId" => $user]);
        break;
    case 15:
        #kill
        if (!$db->userExists($associate)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to die as ID 0");
            exit;
        }
        
        if (!$db->userExists($user)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to kill as ID 0");
            exit;
        }

        if (isset($_GET["Key"])) {
            if ($_GET["Key"] == "AWESOME1SAUCE") {
                $stmt = "UPDATE users SET kos = kos + 1 WHERE id=:userId";
                $db->execute($stmt, [":userId" => $user]);
                $stmt = "INSERT INTO `statistics` (killer, victim, died_at) VALUES (:killer, :victim, :died_at)";
                $db->execute($stmt, [
                    ":killer" => $user,
                    ":victim" => $associate,
                    ":died_at" => date("Y-m-d H:i:s")
                ]);
                $player = new User($user);
                $player->giveTix(10);
                #Discord::sendWebhookMessage("games", $player->getUsername() . " got a kill");
            } else {
                Discord::sendWebhookMessage("weird", "Someone tried to access KOs API but set a bad key");
            }
        }
        break;
    case 16:
        #death
        if (!$db->userExists($user)) {
            echo "bad";
            Discord::sendWebhookMessage("weird", "Someone tried to die as ID 0");
            exit;
        }

        if (isset($_GET["Key"])) {
            if ($_GET["Key"] == "SUPER1SADGRRR") {
                $stmt = "UPDATE users SET wos = wos + 1 WHERE id=:userId";
                $db->execute($stmt, [":userId" => $user]);
                #Discord::sendWebhookMessage("games", $player->getUsername() . " died");
            } else {
                Discord::sendWebhookMessage("weird", "Someone tried to access WOs API but set a bad key");
            }
        }
        break;
}
?>