<?php
class Gameservers {
    public static string $key = "8u09nhoasNHDXAOSHDL";
    
    private static function getDb() {
        global $db;
        return $db;
    }

    public static function getActive() {
        return self::getDb()->execute("SELECT * FROM servers")
                            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countRunning() {
        return (int) self::getDb()->execute("SELECT COUNT(*) FROM servers")
                                  ->fetchColumn();
    }

    public static function countTotalPlayers() {
        return (int) self::getDb()->execute("SELECT SUM(players) FROM servers")
                                  ->fetchColumn();
    }

    public static function serverExists($serverPort) {
        return (bool) self::getDb()->execute(
            "SELECT 1 FROM servers WHERE port=:serverPort LIMIT 1",
            [":serverPort" => $serverPort]
        )->fetchColumn();
    }

    public static function countGames() {
        return (int) self::getDb()->execute(
            "SELECT COUNT(DISTINCT placeId) FROM servers"
        )->fetchColumn();
    }

    public static function playersToGameRatio() {
        $players = self::countTotalPlayers();
        $games = self::countGames();
        $games = $games > 0 ? $games : 1;
        return round($players / $games, 1) . ":1";
    }

    public static function countWaiting() {
        return 0;
    }

    public static function getProcessIds() {
        $stmt = self::getDb()->execute("SELECT pid FROM servers");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getServerByPid(int $pid) {
        return self::getServerByColumn("pid", $pid);
    }

    public static function getServerByPort(int $port) {
        return self::getServerByColumn("port", $port);
    }

    public static function getServerById(int $id) {
        return self::getServerByColumn("id", $id);
    }

    private static function getServerByColumn(string $column, $value) {
        return self::getDb()->execute(
            "SELECT * FROM servers WHERE $column = :value LIMIT 1",
            [":value" => $value]
        )->fetch(PDO::FETCH_ASSOC);
    }

    public static function newServer($placeId) {
        return Server::callAPI(fullDomain . "/api/public/StartServer.php?PlaceID=$placeId");
    }

    public static function getPlayers($serverId) {
        $playerData = self::getDb()->execute(
            "SELECT playerTable FROM servers WHERE id=:serverId",
            [":serverId" => $serverId]
        )->fetchColumn();

        return $playerData ? unserialize($playerData) : false;
    }

    public static function findBestServer($placeId) {
        $playersMax = (int) self::getDb()->execute(
            "SELECT playersMax FROM items WHERE itemId=:placeId",
            [":placeId" => $placeId]
        )->fetchColumn();

        $serverId = self::getDb()->execute(
            "SELECT id FROM servers 
             WHERE placeId=:placeId AND players < :playersMax 
             ORDER BY players DESC LIMIT 1",
            [":placeId" => $placeId, ":playersMax" => $playersMax]
        )->fetchColumn();

        return $serverId ?: 0;
    }

    public static function isFull(int $serverId) {
        $server = self::getServerById($serverId);
        if (!$server) return false;

        $playersMax = (int) self::getDb()->execute(
            "SELECT playersMax FROM items WHERE itemId=:itemId",
            [":itemId" => $server["placeId"]]
        )->fetchColumn();

        return $server["players"] >= $playersMax;
    }

    public static function getMax(int $serverId) {
        $server = self::getServerById($serverId);
        if (!$server) return false;

        return (int) self::getDb()->execute(
            "SELECT playersMax FROM items WHERE itemId=:itemId",
            [":itemId" => $server["placeId"]]
        )->fetchColumn();
    }

    public static function serversOnPlace(int $placeId) {
        return self::getDb()->execute(
            "SELECT COUNT(*) as serverCount FROM servers WHERE placeId=:placeId",
            [":placeId" => $placeId]
        )->fetchColumn();
    }

    public static function getAPIKey(string $api) {
        return match($api) {
            "Close" => "Y2M0YjFjNzNhZWY5YzAyYjkzNmM1NzFlZjg3MWZmODc=",
            "Start" => "Njk0YzJmM2E0M2JkNDE3YTg1Yzc0ZTg0MzRkZTM5MzQ=",
            default => null,
        };
    }

    public static function restartGrid() {
        $pid = self::getGridPid();
        if ($pid) shell_exec("taskkill /PID $pid /F");
        self::startGrid();
    }

    public static function startGrid() {
        $cmd = 'start "" /D "C:\Program Files (x86)\ROBLOX Corporation\RCCService" BCCService.exe -console -placeid:1818 -port 43241';
        pclose(popen("cmd /c $cmd", "r"));
    }

    public static function gridOnline() {
        $result = shell_exec("netstat -aon | findstr :43241");
        return $result && str_contains($result, "LISTENING");
    }

    private static function getGridPid() {
        $result = shell_exec("netstat -aon | findstr :43241");
        if (!$result) return null;
        $parts = preg_split('/\s+/', trim($result));
        return $parts[sizeof($parts) - 1] ?? null;
    }
}
?>