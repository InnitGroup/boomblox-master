<?php
class Gameservers {
    public static function getActive() {
        global $db;
        $stmt = "SELECT * FROM servers";
        $result = $db->execute($stmt);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function countRunning() {
        global $db;
        $stmt = "SELECT COUNT(*) FROM servers";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
    }
    public static function countTotalPlayers() {
        global $db;
        $stmt = "SELECT players FROM servers";
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        $players = 0;
        foreach ($fetched as $server) {
            $players += $server["players"];
        }
        return $players;
    }
    public static function serverExists($serverPort) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE port=:serverPort";
        $result = $db->execute($stmt, [":serverPort" => $serverPort]);
        return $result->rowCount() > 0;
    }
    public static function countGames() {
        global $db;
        $stmt = "SELECT COUNT(DISTINCT placeId) AS games FROM servers";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["games"];
    }
    public static function playersToGameRatio() {
        $players = self::countTotalPlayers();
        $games = self::countGames() > 0 ? self::countGames() : 1;
        $ratio = round($players/$games, 1);
        return $ratio . ":1";
    }
    public static function countWaiting() {
        return 0;
    }
    public static function getProcessIds() {
        global $db;
        $stmt = "SELECT pid FROM servers";
        $result = $db->execute($stmt);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getServerByPid(int $processId) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE pid=:pid";
        $result = $db->execute($stmt, [":pid" => $processId]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public static function getServerByPort(int $port) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE port=:port";
        $result = $db->execute($stmt, [":port" => $port]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public static function getServerById(int $id) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public static function newServer($placeId) {
        return Server::callAPI(fullDomain."/api/public/StartServer.php?PlaceID=$placeId");
    }
    public static function findBestServer($placeId) {
        global $db;
        $stmt = "SELECT playersMax from items WHERE itemId=:placeId";
        $result = $db->execute($stmt, [":placeId" => $placeId]);
        $playersMax = $result->fetch(PDO::FETCH_ASSOC)["playersMax"];

        $stmt = "SELECT * FROM servers WHERE placeId=:placeId AND players < :playersMax ORDER BY players DESC";
        $result = $db->execute($stmt, [":placeId" => $placeId, ":playersMax" => $playersMax]);
        
        if ($result->rowCount() > 0) {
            $server = $result->fetch(PDO::FETCH_ASSOC);
            $id = $server["id"];
            return $id;
        }

        return 0;

    }
    public static function isFull(int $serverId) {
        global $db;
        $stmt = "SELECT * FROM servers WHERE id=:serverId";
        $result = $db->execute($stmt, [":serverId" => $serverId]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $server = $result->fetch(PDO::FETCH_ASSOC);
        $placeId = $server["placeId"];
        $players = $server["players"];

        $stmt = "SELECT playersMax FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $placeId]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $place = $result->fetch(PDO::FETCH_ASSOC);

        return $players >= $place["playersMax"];
    }
    public static function getMax(int $serverId) {
        global $db;
        $stmt = "SELECT placeId FROM servers WHERE id=:serverId";
        $result = $db->execute($stmt, [":serverId" => $serverId]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $server = $result->fetch(PDO::FETCH_ASSOC);
        $placeId = $server["placeId"];

        $stmt = "SELECT playersMax FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $placeId]);

        if ($result->rowCount() == 0) {
            return false;
        }

        $place = $result->fetch(PDO::FETCH_ASSOC);

        return $place["playersMax"];
    }
    public static function getAPIKey(string $api) {
        switch ($api) {
            case "Close":
                return "Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=";
            case "Start":
                return "Njk0YzJmM2E0M2JkNDE3YTg1Yzc0ZTg0MzRkZTM5MzQ=";
        }
    }
    public static function restartGrid() { 
        $cmd = "netstat -aon | findstr :43241";
        $result = shell_exec($cmd);
        $explodedResult = explode(" ", $result);
        $pid = trim($explodedResult[37]);
        $cmd = "taskkill /PID $pid /F";
        shell_exec($cmd);

        $cmd = 'start "" /D "C:\Program Files (x86)\ROBLOX Corporation\RCCService" BCCService.exe -console -placeid:1818 -port 43241';
        pclose(popen("cmd /c $cmd", "r"));
    }
    public static function startGrid() { 
        $cmd = 'start "" /D "C:\Program Files (x86)\ROBLOX Corporation\RCCService" BCCService.exe -console -placeid:1818 -port 43241';
        pclose(popen("cmd /c $cmd", "r"));
    }
    public static function gridOnline() {
        $cmd = "netstat -aon | findstr :43241";
        $result = shell_exec($cmd);
        if (empty($result)) {
            return false;
        }
        
        return str_contains($result, "LISTENING");
    }
}
?>