<?php
class Version {
    public static function assetExists(int $assetId): bool {
        $directory = $_SERVER["DOCUMENT_ROOT"] . "/content/";

        if (!file_exists($directory . $assetId)) {
            return false;
        }

        return true;
    }

    public static function assetVersionExists(int $assetId, int $versionId): bool {
        $directory = $_SERVER["DOCUMENT_ROOT"] . "/content/";

        if (!file_exists($directory . $assetId . "_" . $versionId)) {
            return false;
        }

        return true;
    }

    public static function getNextVersion(int $assetId): int {
        global $db;

        $stmt = "SELECT versionId FROM versions WHERE assetId=:assetId ORDER BY versionId DESC";
        $result = $db->execute($stmt, [":assetId" => $assetId]);
        if ($result->rowCount() == 0) {
            return 2;
        }

        $versionIds = $result->fetch(PDO::FETCH_ASSOC);
        return (int)$versionIds["versionId"] + 1;
    }

    public static function getVersion(int $assetId): int {
        global $db;

        $stmt = "SELECT versionId FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $assetId]);
        if ($result->rowCount() == 0) {
            return 1;
        }

        $versionIds = $result->fetch(PDO::FETCH_ASSOC);
        return (int)$versionIds["versionId"];
    }

    public static function getVersions(int $assetId, int $limit = 0, int $offset = 0) {
        global $db;

        $stmt = "SELECT * FROM versions WHERE assetId=:assetId ORDER BY versionId DESC";
        if ($limit > 0) {
            $stmt .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $stmt .= " OFFSET $offset";
        }

        $result = $db->execute($stmt, [":assetId" => $assetId]);

        $versionIds = $result->fetchAll(PDO::FETCH_ASSOC);
        return $versionIds;
    }

    public static function logVersion(int $assetId, int $versionId, User $creator) {
        global $db, $user;

        $stmt = "INSERT INTO versions (assetId, versionId, created_at, creatorId) VALUES (:assetId, :versionId, :_now, :creatorId)";
        $db->execute($stmt, [
            ":assetId" => $assetId,
            ":versionId" => $versionId,
            ":_now" => date("Y-m-d H:i:s"),
            ":creatorId" => $creator->getUserId()
        ]);
    }

    public static function setVersion(int $assetId, int $versionId) {
        global $db, $user;

        $stmt = "UPDATE items SET versionId=:versionId WHERE itemId=:assetId";
        $db->execute($stmt, [
            ":assetId" => $assetId,
            ":versionId" => $versionId
        ]);
    }

    public static function makeCurrent(int $assetId, int $versionId) {
        if (!self::assetVersionExists($assetId, $versionId)) {
            return false;
        }

        $current = $_SERVER["DOCUMENT_ROOT"] . "/content/$assetId";
        $version = self::getVersion($assetId);
        $nextVersion = self::getNextVersion($assetId);

        $breadVersion = $current . "_" . (string)$versionId; # version to replace new
        $sfothVersion = $current . "_" . (string)$version; # attaching a version to modern version and moving it back

        /*
        we need to move the current place to it's corresponding version (current -> version)
        we need to move the last place to the current place file (next -> current)
        */

        $sfoth = file_get_contents($current);
        $bread = file_get_contents($breadVersion);

        # only way that i can make this make sense :thumbs_up:

        file_put_contents((string)$breadVersion, $bread); # SOMETHING ISNT RIGHT HERE
        file_put_contents((string)$sfothVersion, $sfoth); # sfoth goes to version
        file_put_contents((string)$current, $bread);
        # self::logVersion($assetId, $nextVersion);
        self::setVersion($assetId, $versionId);
    }

    public static function formatDate(string $date) {
        $actualDate = new DateTime($date);
        return $actualDate->format("m/d/Y g:i:s A");
    }
}
?>