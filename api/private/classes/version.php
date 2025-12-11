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

        $stmt = "SELECT versionId FROM assets WHERE assetId=:assetId ORDER BY versionId DESC";
        $result = $db->execute($stmt, [":assetId" => $assetId]);
        if ($result->rowCount() == 0) {
            return 2;
        }

        $versionIds = $result->fetch(PDO::FETCH_ASSOC);
        return (int)$versionIds["versionId"] + 1;
    }

    public static function getVersion(int $assetId): int {
        global $db;

        $stmt = "SELECT versionId FROM assets WHERE assetId=:assetId ORDER BY versionId DESC";
        $result = $db->execute($stmt, [":assetId" => $assetId]);
        if ($result->rowCount() == 0) {
            return 1;
        }

        $versionIds = $result->fetch(PDO::FETCH_ASSOC);
        return (int)$versionIds["versionId"];
    }

    public static function logVersion(int $assetId, int $versionId) {
        global $db, $user;

        $stmt = "INSERT INTO versions (assetId, versionId, created_at, creatorId) VALUES (:assetId, :versionId, :_now, :creatorId)";
        $db->execute($stmt, [
            ":assetId" => $assetId,
            ":versionId" => $versionId,
            ":_now" => date("Y-m-d H:i:s"),
            ":creatorId" => $user->getUserId()
        ]);
    }
}
?>