<?php

# for general admin tools and data
class Admin {

    # all options for the admin panel's link tree
    private static $linkTreeOptions = [
        [
            "Title" => "My ROBLOX",
            "Link" => "/User.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Admin Dashboard",
            "Link" => "/Admi/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Configuration",
            "Link" => "/Admi/Bayesian/Default.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Shoutbox",
            "Link" => "/Admi/Shoutbox/Default.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Cores",
            "Link" => "/Admi/Cores.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Economy",
            "Link" => "/Admi/Economy/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Award Product",
            "Link" => "/Admi/Economy/AwardProduct.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Revoke Product",
            "Link" => "/Admi/Economy/RevokeProduct.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "New Product",
            "Link" => "/Admi/Economy/NewProduct.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Robux Adjustment",
            "Link" => "/Admi/Economy/RobuxAdjustment.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Product Queue",
            "Link" => "/Admi/Economy/ProductQueue.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Grid",
            "Link" => "/Admi/Grid/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Deployer",
            "Link" => "/Admi/Grid/Deploy.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Games",
            "Link" => "/Admi/Grid/Games.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Manage",
            "Link" => "/Admi/Grid/Manage.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Render",
            "Link" => "/Admi/Grid/Render.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Keys",
            "Link" => "/Admi/Keys/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Generate Key",
            "Link" => "/Admi/Keys/New.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Moderation",
            "Link" => "/Admi/Moderation/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Block Asset",
            "Link" => "/Admi/Moderation/BlockAsset.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Testing",
            "Link" => "/Admi/Testing/Default.aspx",
            "Level" => 1,
        ],
        [
            "Title" => "Asset Downloader",
            "Link" => "/Admi/Testing/AssetDownloader.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "Asset List",
            "Link" => "/Admi/Testing/AssetList.aspx",
            "Level" => 2,
        ],
        [
            "Title" => "ROBLOX Image Viewer",
            "Link" => "/Admi/Testing/AssetViewer.aspx",
            "Level" => 2,
        ],
    ];

    # all possible punishments to give a user
    private static $punishments = [
        #1 => "None",
        2 => "Remind",
        3 => "Warn",
        4 => "Ban 1 Day",
        5 => "Ban 3 Days",
        6 => "Ban 7 Days",
        7 => "Ban 14 Days",
        8 => "Delete",
        9 => "Poison"
    ];

    # return all punishments standing or not of a user, by their user id
    public static function getPunishments($userId) {
        global $db;
        $stmt = "SELECT * FROM moderation WHERE userId=:userId";
        $result = $db->execute($stmt, [":userId" => $userId]);
        if ($result->rowCount() > 0) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    # accepts a pending asset via asset id
    public static function acceptAsset($assetId) {
        global $db;
        $stmt = "UPDATE items SET `status`='accepted', lastUpdate=:lastUpdate WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $assetId, ":lastUpdate" => date("Y-m-d H:i:s")]);

        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $assetId]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);

        $assetType = $fetched["catalogType"] !== NULL ? $fetched["catalogType"] : $fetched["itemType"];
        if (!in_array($assetType, ["T-Shirt", "Shirt", "Pants", "Decal"])) {
            return false;
        }

        $file = File::getImageType($_SERVER["DOCUMENT_ROOT"]."/cdn/t3/$assetId");
        if ($file["Extension"] == "image/jpeg" || $file["Extension"] == "jpg") {
            File::JPGtoPNG($file["FullPath"], $_SERVER["DOCUMENT_ROOT"]."/cdn/t3/$assetId.png");
        }
        $path = $_SERVER["DOCUMENT_ROOT"]."/cdn/t3/$assetId.png";

        $assetTexture = file_get_contents($path);
        if ($assetType !== "Decal") {
            $asset = new File("/api/private/xml/$assetType.xml", ["1" => "http://".domain."/content/".$assetId."_1.png"]);
            $asset = $asset->handle();
            #$assetTexture = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/cdn/t3/$assetId.png");

            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/".$assetId."_1.png", $assetTexture);
            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/$assetId", $asset);

            $thumb = new Asset($assetId);
            $thumb->RequestThumbnail(250, 250, "PNG");
        } else {
            #$assetTexture = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/cdn/t3/$assetId.png");
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/" . (string)$assetId, $assetTexture);
        }
    }

    # accepts an ad
    public static function acceptAd($assetId) {
        global $db;
        $stmt = "UPDATE ads SET `status` = 'stopped' WHERE id=:assetId";
        $db->execute($stmt, [":assetId" => $assetId]);
    }

    # blocks an asset, regardless of pending or not, by asset id
    public static function blockAsset($assetId) {
        global $db;
        $stmt = "UPDATE items SET `status`='blocked', lastUpdate=:lastUpdate WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $assetId, ":lastUpdate" => date("Y-m-d H:i:s")]);
    }

    # blocks an ad
    public static function blockAd($assetId) {
        global $db;
        $stmt = "UPDATE ads SET `status` = 'rejected' WHERE id=:assetId";
        $db->execute($stmt, [":assetId" => $assetId]);
    }

    # returns a list or count of users to review (TBD)
    public static function getUsersToReview($count = false) {
        return 0; # TEMP
    }

    # backs up the database to github
    public static function backupDatabase() {
        $host = "localhost";
        $user = "root";
        $password = Database::getPassword();
        $dbname = Database::getName();

        $backupPath = "C:/htdocs/api/private/sql/";
        $date = date("m-d-y-h-i-s");
        $filename = $backupPath . "dump-" . $date . ".sql";

        $mysqldump = "C:/xampp/mysql/bin/mysqldump.exe";

        $command = "\"$mysqldump\" --host=$host --user=$user --password=$password $dbname";

        $output = [];
        $result = null;
        exec($command, $output, $result);

        if ($result === 0 && !empty($output)) {
            file_put_contents($filename, implode("\n", $output));
        } else {
            file_put_contents($filename, "Failed to backup");
        }

        exec("git add $filename");
        exec('git commit -m "Common database backup');

        $gitOutput; $gitResult;
        exec("git push origin master --force 2>&1", $gitOutput, $gitResult);
    }

    # returns a count or list of reports to review
    public static function getReportsToReview($count = false) {
        global $db;
        if ($count) {
            $stmt = "SELECT COUNT(*) FROM reports WHERE handled=0";
            $result = $db->execute($stmt);
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched["COUNT(*)"];
        } else {
            $stmt = "SELECT * FROM reports ORDER BY id DESC";
            $result = $db->execute($stmt);
            $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
            return $fetched;
        }
    }

    # returns a count or list of images to review
    public static function getImagesToReview($count = false) {
        global $db;
        $stmt = "SELECT * FROM items WHERE `status`='pending' AND `catalogType` IN ('Shirt', 'Pants', 'T-Shirt', 'Decal')";
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        if ($count) {
            return count($fetched);
        }
        return $fetched;
    }

    public static function getAdsToReview($count = true) {
        global $db;
        $stmt = "SELECT * FROM ads WHERE `status`='pending'";
        $result = $db->execute($stmt);
        $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
        if ($count) {
            return count($fetched);
        }
    }

    public static function getOwners(int $itemId) {
        global $db;

        $stmt = "SELECT items, username FROM users";
        $result = $db->execute($stmt);

        if ($result->rowCount() == 0) {
            return [];
        }

        $owners = [];
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $individualData) {
            if ($individualData["items"] !== NULL && $individualData["items"] !== "0") {
                $decodedInventory = unserialize($individualData["items"]);
                if (in_array($itemId, $decodedInventory)) {
                    array_push($owners, $individualData["username"]);
                }
            }
        }

        return $owners;
    }

    # get of linkTreeOptions array
    public static function getLinkTreeOptions() {
        return self::$linkTreeOptions;
    }

    # get of punishments array
    public static function getPunishmentsArray() {
        return self::$punishments;
    }

    # returns a punishment name based on the given punishment id
    public static function getPunishmentTypeFromId($punishmentId) {
        switch ($punishmentId) {
            case 2:
                return "Reminder";
            case 3:
                return "Warn";
            case 4:
            case 5:
            case 6:
            case 7:
                return "Ban";
            case 8:
                return "Termination";
            case 9:
                return "Poison";
        }
    }

    # returns how long a punishment is (in days) based on the given id
    public static function getPunishmentLengthFromId($punishmentId) {
        switch ($punishmentId) {
            #case 1:
            #    return 0;
            case 2:
                return 0;
            case 3:
                return 0;
            case 4:
                return 1;
            case 5:
                return 3;
            case 6:
                return 7;
            case 7:
                return 14;
            case 8:
                return 1;
            case 9:
                return 1;
        }
    }

    # returns all alternate accounts of a user (WIP)
    public static function getAltsOfUser($userId) {
        global $db;
        $user = new User($userId);
        $ip = $user->getLastIp();

        $stmt = "SELECT * FROM users WHERE lastIp=:ip";
        $result = $db->execute($stmt, [":ip" => $ip]);
        if ($result->rowCount() > 0) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>