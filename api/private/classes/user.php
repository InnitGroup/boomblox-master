<?php
class User {
    private $data = [
        "user" => [
            "id",
            "username",
            "boombux",
            "email",
            "tix",
            "blurb",
            "theme",
            "characterImage",
            "level",
            "friends",
            "favorites",
            "items",
            "forumPosts",
            "pviews",
            "kos",
            "wos",
            "reg_date",
            "lastOnline",
            "terminal",
            "event",
            "verified",
            "dynamicIp",
            "firstIp",
            "lastIp",
        ],
        "character" => [
            "headColor",
            "laColor",
            "raColor",
            "llColor",
            "rlColor",
            "torsoColor",
            "head",
            "face",
            "gear",
            "hat",
            "shirt",
            "pants",
            "t-shirt",
        ],
        "membership" => [
            "bc",
            "bcExpires",
        ],
        "client" => [
            "jointoken",
            "joincode",
            "clientMd5",
            "clientMd5Changed"
        ],
        "forums" => [
            "timezone",
            "occupation",
            "interests",
            "aim",
            "icq",
            "location",
            "msn",
            "yahoo",
            "website",
            "pemail",
            "signature"
        ]
    ];
    public function __construct($userId) {
        global $db;
        $stmt = "SELECT * FROM users WHERE id=:id";
        $result = $db->execute($stmt,[":id" => $userId]);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            Helper::directData($result, $this->data["user"]);
            Helper::directData($result, $this->data["character"]);
            Helper::directData($result, $this->data["membership"]);
            Helper::directData($result, $this->data["client"]);
            Helper::directData($result, $this->data["forums"]);
        }
    }

    public function getTicket() {
        return $this->data["client"]["joincode"];
    }

    public function getBlurb() {
        return isset($this->data["user"]["blurb"]) ? $this->data["user"]["blurb"] : "";
    }

    public function lastPost() {
        global $db;
        $stmt = "SELECT postId FROM threads WHERE author=:userId ORDER BY postId DESC";
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);
        if ($result->rowCount() == 0) {
            return false;
        }

        $result = $result->fetch(PDO::FETCH_ASSOC);

        return new Thread($result["postId"]);
    }

    public function lastAsset() {
        global $db;
        $stmt = "SELECT * FROM items WHERE creatorId=:userId ORDER BY lastUpdate DESC";
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);
        if ($result->rowCount() == 0) {
            return false;
        }

        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function timeSinceLastAsset() {
        $result = $this->lastAsset();
        
        $lastUpdate = new DateTime($result["lastUpdate"]);
        return max(0, time() - $lastUpdate->getTimestamp());
    }

    public function isVerified(): bool {
        return isset($this->data["user"]["verified"]) ? (bool)$this->data["user"]["verified"] : false;
    }

    public function getData($dataType = "user", $property = "id") {
        return $this->data[$dataType][$property] ?? NULL;
    }

    public function getSection($dataType = "user") {
        return $this->data[$dataType];
    }

    public function getEmail() {
        return $this->data["user"]["email"];
    }

    # forum interaction functions
    public function getTimezone() {
        return $this->data["forums"]["timezone"];
    }

    public function getOccupation() {
        return $this->data["forums"]["occupation"];
    }

    public function getInterests() {
        return $this->data["forums"]["interests"];
    }

    public function getAIM() {
        return $this->data["forums"]["aim"];
    }

    public function getICQ() {
        return $this->data["forums"]["icq"];
    }

    public function getLocation() {
        return $this->data["forums"]["location"];
    }

    public function getMSN() {
        return $this->data["forums"]["msn"];
    }

    public function getClientMd5() {
        return $this->data["client"]["clientMd5"];
    }

    public function getClientMd5Changed() {
        return new DateTime($this->data["client"]["clientMd5Changed"]);
    }

    public function getTimeSinceLastClientMd5() {
        $lastMd5 = new DateTime($this->data["client"]["clientMd5Changed"]);
        return time() - $lastMd5->getTimestamp();
    }

    public function setClientMd5(string $md5) {
        global $db;

        $stmt = "UPDATE users SET clientMd5 = :clientMd5, clientMd5Changed = :clientMd5Changed WHERE id=:userId";
        $db->execute($stmt, [
            ":clientMd5" => $md5,
            ":clientMd5Changed" => date("Y-m-d H:i:s"),
            ":userId" => $this->getUserId()
        ]);
    }

    public function getYahoo() {
        return $this->data["forums"]["yahoo"];
    }

    public function getWebsite() {
        return $this->data["forums"]["website"];
    }

    public function getPemail() {
        return $this->data["forums"]["pemail"];
    }

    public function getSignature() {
        return $this->data["forums"]["signature"];
    }

    public function setTimezone(int $timezone) {
        global $db;
        $stmt = "UPDATE users SET timezone=:timezone WHERE id=:userId";
        $db->execute($stmt, [":timezone" => $timezone, ":userId" => $this->getUserId()]);
    }

    public function setOccupation(string $occupation) {
        global $db;
        $stmt = "UPDATE users SET occupation=:occupation WHERE id=:userId";
        $db->execute($stmt, [":occupation" => $occupation, ":userId" => $this->getUserId()]);
    }

    public function setInterests(string $interests) {
        global $db;
        $stmt = "UPDATE users SET interests=:interests WHERE id=:userId";
        $db->execute($stmt, [":interests" => $interests, ":userId" => $this->getUserId()]);
    }

    public function setAIM(string $aim) {
        global $db;
        $stmt = "UPDATE users SET aim=:aim WHERE id=:userId";
        $db->execute($stmt, [":aim" => $aim, ":userId" => $this->getUserId()]);
    }

    public function setICQ(string $icq) {
        global $db;
        $stmt = "UPDATE users SET icq=:icq WHERE id=:userId";
        $db->execute($stmt, [":icq" => $icq, ":userId" => $this->getUserId()]);
    }

    public function setLocation(string $location) {
        global $db;
        $stmt = "UPDATE users SET `location`=:xlocation WHERE id=:userId";
        $db->execute($stmt, [":xlocation" => $location, ":userId" => $this->getUserId()]);
    }

    public function setMSN(string $msn) {
        global $db;
        $stmt = "UPDATE users SET msn=:msn WHERE id=:userId";
        $db->execute($stmt, [":msn" => $msn, ":userId" => $this->getUserId()]);
    }

    public function setYahoo(string $yahoo) {
        global $db;
        $stmt = "UPDATE users SET yahoo=:yahoo WHERE id=:userId";
        $db->execute($stmt, [":yahoo" => $yahoo, ":userId" => $this->getUserId()]);
    }

    public function setWebsite(string $website) {
        global $db;
        $stmt = "UPDATE users SET website=:website WHERE id=:userId";
        $db->execute($stmt, [":website" => $website, ":userId" => $this->getUserId()]);
    }

    public function setPemail(string $pemail) {
        global $db;
        $stmt = "UPDATE users SET pemail=:pemail WHERE id=:userId";
        $db->execute($stmt, [":pemail" => $pemail, ":userId" => $this->getUserId()]);
    }

    public function setSignature(string $signature) {
        global $db;
        $stmt = "UPDATE users SET `signature`=:xsignature WHERE id=:userId";
        $db->execute($stmt, [":xsignature" => $signature, ":userId" => $this->getUserId()]);
    }

    public function getDataTable($dataType = "user") {
        return $this->data[$dataType] ?? NULL;
    }

    public function getCharacter() {
        return $this->data["character"];
    }

    public function getUserId() {
        return $this->data["user"]["id"];
    }

    public function getAds($limit = 0) {
        global $db;

        $stmt = "SELECT id FROM ads WHERE creator=:userId AND archived=0";
        if ($limit > 0) {
            $stmt .= " LIMIT $limit";
        }
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);

        $ads = [];
        if ($result->rowCount() > 0) {
            $fetchedAds = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fetchedAds as $fetchedAd) {
                array_push($ads, new UserAd($fetchedAd["id"]));
            }
        }

        return $ads;
    }
    public function isStaff() {
        return $this->data["user"]["level"] > 1;
    }
    public function hasPerms($perm) {
        return $this->data["user"]["level"] >= $perm;
    }
    public function typeStaff() {
        $result = array();
        $level = $this->data["user"]["level"];
        if ($level >= 6) {
            array_push($result, "Administrator");
        }
        if ($level == 5) {
            array_push($result, "SuperModerator");
        }
        if ($level >= 4) {
            array_push($result, "ForumModerator");
        }
        if ($level >= 3) {
            array_push($result, "ImageModerator");
        }
        if ($level == 2) {
            array_push($result, "FakeMod");
        }
        if ($level == 1) {
            array_push($result, "N/A");
        }

        return $result;
    }

    public function getTrades($limit = 10, $offset = 0, $status = "complete") {
        global $db;
        $stmt = "SELECT postId FROM trades WHERE traderId=:userId AND `status`=:xstatus ORDER BY postId DESC LIMIT $limit OFFSET $offset"; // 
        
        $result = $db->execute($stmt, [
            ":userId" => $this->getUserId(),
            ":xstatus" => $status
        ]);

        $indexedTrades = $result->fetchAll(PDO::FETCH_ASSOC);

        $trades = [];
        foreach ($indexedTrades as $indexedTrade) {
            $trade = new CurrencyTrade($indexedTrade["postId"]);
            array_push($trades, $trade);
        }

        return $trades;
    }

    public function getTicketTrades($limit = 10, $offset = 0, $status = "processing") {
        global $db;
        $stmt = "SELECT postId FROM trades WHERE traderId=:userId AND `currency` = 'Tickets' AND `status`=:xstatus ORDER BY postId DESC LIMIT $limit OFFSET $offset"; // 
        
        $result = $db->execute($stmt, [
            ":userId" => $this->getUserId(),
            ":xstatus" => $status
        ]);

        $indexedTrades = $result->fetchAll(PDO::FETCH_ASSOC);

        $trades = [];
        foreach ($indexedTrades as $indexedTrade) {
            $trade = new CurrencyTrade($indexedTrade["postId"]);
            array_push($trades, $trade);
        }

        return $trades;
    }

    public function getBuxTrades($limit = 10, $offset = 0, $status = "processing") {
        global $db;
        $stmt = "SELECT postId FROM trades WHERE traderId=:userId AND `currency` = 'Robux' AND `status`=:xstatus ORDER BY postId DESC LIMIT $limit OFFSET $offset"; // 
        
        $result = $db->execute($stmt, [
            ":userId" => $this->getUserId(),
            ":xstatus" => $status
        ]);

        $indexedTrades = $result->fetchAll(PDO::FETCH_ASSOC);

        $trades = [];
        foreach ($indexedTrades as $indexedTrade) {
            $trade = new CurrencyTrade($indexedTrade["postId"]);
            array_push($trades, $trade);
        }

        return $trades;
    }

    public function getRoleset() {
        $level = $this->data["user"]["level"];
        switch ($level) {
            case 7:
                return "Owner";
            case 6:
                return "Administrator";
            case 5: 
                return "Super Moderator";
            case 4:
                return "Forum Moderator";
            case 3:
                return "Image Moderator";
            case 2:
                return "N/A";
            case 1:
                return "Member";
            default:
                return "Member";
        }
    }

    public function joinDate($since = false) {
        $joinDate = new DateTime($this->getData("user","reg_date"));
        if ($since) {
            $now = new DateTime();
            $diff = $now->diff($joinDate);
            return $diff->days;
        }
        return $joinDate;
    }
    public function lastDate() {
        return new DateTime($this->getData("user", "lastOnline"));
    }
    public function takeTix($amount) {
        global $db;
        $stmt = "UPDATE users SET tix = tix - :amount WHERE id=:id";
        $db->execute($stmt, [
            ":amount" => (int)$amount,
            ":id" => $this->getUserId(),
        ]);
    }
    public function takeBux($amount) {
        global $db;
        $stmt = "UPDATE users SET boombux = boombux - :amount WHERE id=:id";
        $db->execute($stmt, [
            ":amount" => (int)$amount,
            ":id" => $this->getUserId(),
        ]);
    }
    public function giveTix($amount) {
        global $db;
        $stmt = "UPDATE users SET tix = tix + :amount WHERE id=:id";
        $db->execute($stmt, [
            ":amount" => (int)$amount,
            ":id" => $this->getUserId(),
        ]);
    }
    public function giveBux($amount) {
        global $db;
        $stmt = "UPDATE users SET boombux = boombux + :amount WHERE id=:id";
        $db->execute($stmt, [
            ":amount" => (int)$amount,
            ":id" => $this->getUserId(),
        ]);
    }
    public function hasTix($amount) {
        global $db;
        return $this->data["user"]["tix"] >= $amount;
    }
    public function hasBux($amount) {
        global $db;
        return $this->data["user"]["boombux"] >= $amount;
    }
    public function giveBC(int $months = 1) {
        if ($this->bcExpires(true) > 160) { # if they have more than 5 months worth of bc then they can't be given more 
            return;
        }

        if (!$this->hasItem(118)) {
            $this->giveItem(118);
        }
        
        global $db;
        if (!$this->hasBC()) {
            $expirationDate = new DateTime();
            $expirationDate->add(DateInterval::createFromDateString($months . " " . ($months > 1 ? "months" : "month")));

            $stmt = "UPDATE users SET bcExpires = :expiration, bc = 1 WHERE id=:userId";
            $db->execute($stmt, [
                ":expiration" => $expirationDate->format("Y-m-d H:i:s"),
                ":userId" => $this->getUserId()
            ]);
        } else {
            $expirationDate = new DateTime($this->data["membership"]["bcExpires"]);
            $expirationDate->add(DateInterval::createFromDateString($months . " " . ($months > 1 ? "months" : "month")));

            $stmt = "UPDATE users SET bcExpires=:expiration WHERE id=:userId";
            $db->execute($stmt, [
                ":expiration" => $expirationDate->format("Y-m-d H:i:s"),
                ":userId" => $this->getUserId()
            ]);
            return;
        }

        
    }
    public function takeBC() {
        global $db;
        $stmt = "UPDATE users SET bc=0 WHERE id=:id";
        $db->execute($stmt, [":id" => $this->getUserId()]);
    }
    public function getCharacterAppearance($isRender = false) {
        $charapp = Site::$domain."/Asset/BodyColors.ashx?userid=".$this->data["user"]["id"]."&t=".time();
        if (isset($this->data["character"]["hat"])) {
            $charapp .= ";".Site::$domain."/Asset/?id=".(int)$this->data["character"]["hat"];
        }

        if (isset($this->data["character"]["shirt"])) {
            $asset = new Asset((int)$this->data["character"]["shirt"]);
            if ($asset->IsApproved()) {
                $charapp .= ";".Site::$domain."/Asset/?id=".(int)$this->data["character"]["shirt"];
            }
        }

        if (isset($this->data["character"]["pants"])) {
            $asset = new Asset((int)$this->data["character"]["pants"]);
            if ($asset->IsApproved()) {
                $charapp .= ";".Site::$domain."/Asset/?id=".(int)$this->data["character"]["pants"];
            }
        }

        if (isset($this->data["character"]["t-shirt"])) {
            $asset = new Asset((int)$this->data["character"]["t-shirt"]);
            if ($asset->IsApproved()) {
                $charapp .= ";".Site::$domain."/Asset/?id=".(int)$this->data["character"]["t-shirt"];
            }
        }

        if (!$isRender) {
            if (isset($this->data["character"]["head"]) && $this->data["character"]["head"] > 0) {
                $charapp .= ";".Site::$domain."/content/test/".(int)$this->data["character"]["head"];
            }
            if (isset($this->data["character"]["face"]) && $this->data["character"]["face"] > 0) {
                $charapp .= ";".Site::$domain."/Data/Face.ashx?id=".(int)$this->data["character"]["face"];
            }
            if (isset($this->data["character"]["gear"]) && $this->data["character"]["gear"] > 0) {
                $charapp .= ";".Site::$domain."/asset/?id=".(int)$this->data["character"]["gear"];
            }
        } 

        

        return $charapp;
    }
    public function getAlternateAppearance() {
        return substr(implode("-", array_filter($this->data["character"])), 77);
    }
    public function getHead() {
        return isset($this->data["character"]["head"]) ? $this->data["character"]["head"] : 2268;
    }
    public function getFace() {
        return isset($this->data["character"]["face"]) ? $this->data["character"]["face"] : 1010;
    }
    public function getGear() {
        return isset($this->data["character"]["gear"]) ? $this->data["character"]["gear"] : NULL;
    }
    public function isOnline() {
        if (!$this->getData("user","lastOnline")) {
            return false;
        }

        $lastOnline = new DateTime($this->getData("user","lastOnline"));
        $now = new DateTime();
        $time = $now->getTimestamp() - $lastOnline->getTimestamp();
        return $time <= 3600;
    }
    public function recentForumPosts($count = 10) {
        global $db;
        $stmt = "SELECT postId FROM threads WHERE author=:userId LIMIT $count";
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);

        if ($result->rowCount() == 0) {
            return [];
        }

        $posts = [];
        $fetchedPostIds = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fetchedPostIds as $fetchedPostId) {
            array_push($posts, new Thread($fetchedPostId));
        }

        return $posts;
    }
    public function lastOnline() {
        if (!$this->getData("user","lastOnline")) {
            return "N/A";
        }

        $lastOnline = new DateTime($this->getData("user","lastOnline"));
        $formatted = $lastOnline->format("n/j/Y g:i:s A");
        return $formatted;
    }
    public function getPlaces($idOnly = false) {
        global $db;
        $stmt = "SELECT * FROM items WHERE `creatorId`=:creatorId AND `itemType`='game'";
        $result = $db->execute($stmt,[":creatorId" => $this->data["user"]["id"]]);
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($idOnly) {
                $placeIds = array();
                foreach ($result as $place) {
                    array_push($placeIds, $place["itemId"]);
                }
                return $placeIds;
            }
            return $result;
        } else {
            return array();
        }
    }
    public function ownsPlace($id) {
        return in_array($id, $this->getPlaces(true));
    }
    public function madeModel($id) {
        return in_array($id, $this->getModels(true));
    }
    public function punish($punishmentId, $length, $note, $message) {
        global $db, $user;
        if (isset(Admin::getPunishmentsArray()[$punishmentId])) {
            if (!empty($note) && !empty($message)) {
                $type = Admin::getPunishmentTypeFromId($punishmentId);
                $stmt = "INSERT INTO moderation (userId, actionType, actionSource, actionComment, actionLength, modId) VALUES (:userId, :actionType, :actionSource, :actionComment, :actionLength, :modId)";
                $db->execute($stmt, [
                    ":userId" => $this->getUserId(),
                    ":actionType" => $type,
                    ":actionSource" => $note,
                    ":actionComment" => $message,
                    ":actionLength" => $length,
                    ":modId" => $user->getUserId()
                ]);
            }
        }
    }
    public function isPunished() {
        global $db;
        $stmt = "SELECT * FROM moderation WHERE userId=:userId AND actionActive=1";
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);
        return $result->rowCount() > 0;
    }
    public function getActivePunishment() {
        global $db;
        $stmt = "SELECT * FROM moderation WHERE userId=:userId AND actionActive=1 ORDER BY id DESC";
        $result = $db->execute($stmt, [":userId" => $this->getUserId()]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched;
        }
    }
    public function getModels($idOnly = false) {
        global $db;
        $stmt = "SELECT * FROM items WHERE `creatorId`=:creatorId AND `itemType`='catalog' AND `catalogType`='Model'";
        $result = $db->execute($stmt,[":creatorId" => $this->data["user"]["id"]]);
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            if ($idOnly) {
                $modelIds = array();
                foreach ($result as $model) {
                    array_push($modelIds, $model["itemId"]);
                }
                return $modelIds;
            }
            return $result;
        } else {
            return array();
        }
    }
    public function getAvailablePlaces() {
        global $db;
        $stmt = "SELECT * FROM items WHERE `creatorId`=:creatorId AND `itemType`='game'";
        $result = $db->execute($stmt, [":creatorId" => $this->data["user"]["id"]]);
        $places = $result->rowCount();
        if ($places > 0) {
            if ($this->hasBC()) {
                if ($places <= 10) {
                    return 10-$places;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }
    public function canAccessPlace(int $placeId) {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:placeId";
        $result = $db->execute($stmt, [":placeId" => $placeId]);
        $place = $result->fetch(PDO::FETCH_ASSOC);

        $access = $place["access"];
        $creatorId = $place["creatorId"];
        $creatorName = $place["creatorName"];

        if ($access == 1) {
            return true;
        }

        if ($this->getUserId() == $creatorId) {
            return true;
        }

        if ($this->friendsWith($creatorName)) {
            return true;
        }
    }
    public static function getNameById(int $id) {
        global $db;
        $stmt = "SELECT username FROM users WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $id]);
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)["username"];
        }
    }
    public static function getIdByName(string $name) {
        global $db;
        $stmt = "SELECT id FROM users WHERE username=:username";
        $result = $db->execute($stmt, [":username" => $name]);
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC)["id"];
        }
    }
    public function getVisits() {
        global $db;
        $stmt = "SELECT SUM(interactions) FROM items WHERE `creatorId`=:creatorId AND `itemType`='game'";
        $result = $db->execute($stmt,[":creatorId" => $this->data["user"]["id"]]);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result["SUM(interactions)"] ?? 0;
    }
    public function isTester() {
        if ($this->isStaff()) {
            return true;
        }

        $testers = [91, 3, 123, 113, 126, 108, 100, 93, 73, 124, 86, 76, 79, 135, 137, 132, 149];
        if (in_array($this->getUserId(), $testers)) {
            return true;
        }
    }
    public function getLastWeekVisits(int $placeId = NULL) {
        global $db;
        if ($placeId) {
            $stmt = "SELECT COUNT(*) FROM analytics WHERE `actiondate` >= CURRENT_DATE - INTERVAL 7 DAY AND `actiondate` < CURRENT_DATE AND `place` = :placeId AND actiontype = 'join'";
            $result = $db->execute($stmt, [":placeId" => $placeId]);
            $visits = (int)$result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
            return $visits;
        }

        $places = $this->getPlaces(true);
        $visits = 0;

        foreach ($places as $place) {
            $stmt = "SELECT COUNT(*) FROM analytics WHERE `actiondate` >= CURRENT_DATE - INTERVAL 7 DAY AND `actiondate` < CURRENT_DATE AND `place` = :place";

            $result = $db->execute($stmt, [":place" => $place]);
            $visits = $visits + (int)$result->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        }

        return $visits;
    }
    public function getLastWeekKOs() {
        global $db;

        $stmt = "SELECT killer FROM `statistics` WHERE killer=:killerId AND `died_at` >= CURRENT_DATE - INTERVAL 7 DAY AND `died_at` < CURRENT_DATE";
        $result = $db->execute($stmt, [":killerId" => $this->getUserId()]);
        return $result->rowCount();
    }
    public function getLastWeekWOs() {
        global $db;

        $stmt = "SELECT victim FROM `statistics` WHERE victim=:victimId AND `died_at` >= CURRENT_DATE - INTERVAL 7 DAY AND `died_at` < CURRENT_DATE";
        $result = $db->execute($stmt, [":victimId" => $this->getUserId()]);
        return $result->rowCount();
    }
    public function getUsername() {
        return $this->data["user"]["username"];
    }
    public function declineAllInvites() {
        global $db;
        $userId = $this->getUserId();
        $stmt = "UPDATE messages SET inviteActive=0 WHERE recipientId=:userId";
        $db->execute($stmt,[":userId" => $userId]);
    }
    public function getMessageCount($unread = 1) {
        global $db;
        $userId = $this->getUserId();
        $stmt = "SELECT messageId FROM messages WHERE recipientId=:userId AND unread=".$unread." AND archived=0";
        $result = $db->execute($stmt, [
            ":userId" => $userId
        ]);

        return $result->rowCount();
    }
    public function getMessages($limit = null, $offset = null, $includeArchived = null) {
        global $db;
        $userId = $this->getUserId();
        $stmt = "SELECT * FROM messages WHERE recipientId=:userId";

        if (!isset($includeArchived)) {
            $stmt .= " AND archived=0";
        }

        $stmt .= " ORDER BY messageId DESC";

        if (isset($limit)) {
            $stmt .= " LIMIT " . $limit;
        }

        if (isset($offset)) {
            $stmt .= " OFFSET " . $offset;
        }

        $result = $db->execute($stmt, [
            ":userId" => $userId
        ]);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function acceptAllInvites() {
        global $db;
        $userId = $this->getUserId();

        $stmt = "SELECT senderId FROM messages WHERE inviteActive=1 AND recipientId=:userId";
        $result = $db->execute($stmt,[":userId" => $userId]);
        if ($result->rowCount() > 0) {
            $invites = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($invites as $invite) {
                if ($invite["senderId"] !== $this->getUserId()) {
                    $inviter = new User($invite["senderId"]);
                    $inviter->addFriend($this->getUsername());
                    $this->addFriend($inviter->getUsername());
                }
            }
        }
        
        $stmt = "UPDATE messages SET inviteActive=0 WHERE inviteActive=1 AND recipientId=:userId";
        $db->execute($stmt,[":userId" => $userId]);
    }
    public function givePlace() {
        global $db;
        $placeName = $this->data["user"]["username"]."'s Place";
        $stmt = "SELECT * FROM items WHERE `creatorId`=:creatorId AND `itemType`='game'";
        $result = $db->execute($stmt,[":creatorId" => $this->data["user"]["id"]]);
        if ($result->rowCount() > 0) {
            $placeName .= ": #".$result->rowCount() + 1;
        }
        $stmt = "INSERT INTO items (`itemType`, `creatorId`, `creatorName`, `itemName`, `itemDescription`, `status`) VALUES ('game', :creatorId, :creatorName, :itemName, 'No description available.', 'accepted')";
        $result = $db->execute($stmt,[":creatorId" => $this->data["user"]["id"], ":creatorName" => $this->data["user"]["username"], ":itemName" => Helper::debugString($placeName)]);
        $placeId = $db->singleton()->lastInsertId();
        
        $data = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/content/templates/HappyHomeInBoombloxia");
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/{$placeId}", gzencode($data));
        Version::logVersion($placeId, 1, $this);
        Version::setVersion($placeId, 1, $this);
    }
    public function addProfileView($userId) {
        global $db;

        $profileViews = $this->getProfileViews(false);

        if (!in_array($userId, $profileViews)) {
            array_push($profileViews, $userId);
        }

        $profileViews = serialize($profileViews);
        $userId = $this->getUserId();

        $stmt = "UPDATE users SET pviews=:profileViews WHERE id=:userId";
        $db->execute($stmt, [
            ":profileViews" => $profileViews,
            ":userId" => $userId
        ]);
    }
    public function viewedBy($userId) {
        $profileViews = $this->getProfileViews(false);
        return in_array($userId, $profileViews);
    }
    public function getLastIp() {
        return $this->getData("user", "lastIp");
    }
    public function getFriends($serialized = true) {
        global $db;
        $stmt = "SELECT friends FROM users WHERE id=:id";
        $result = $db->execute($stmt, [":id" => $this->data["user"]["id"]]);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $friends = $result["friends"];
        if ($result["friends"] == 0) {
            $friends = serialize(array());
        }
        if ($serialized) {
            return $friends;
        }
        return unserialize($friends);
    }

    public function friendsWith($friend) {
        $friends = $this->getFriends(false);
        return in_array($friend, $friends);
    }

    public function addFriend($friend) {
        global $db;

        $friends = $this->getFriends(false);
        if (!in_array($friend, $friends)) {
            array_push($friends, $friend);
            $friends = serialize($friends);

            $userId = $this->getUserId();
            
            $stmt = "UPDATE users SET friends=:friends WHERE id=:userId";
            return $db->execute($stmt, [":friends" => $friends, ":userId" => $userId]);
        }
        
    }

    public function removeFriend($friend) {
        global $db;

        $friends = $this->getFriends(false);
        if (in_array($friend, $friends)) {
            $friendToRemove = array_search($friend, $friends);
            unset($friends[$friendToRemove]);
            $friends = serialize($friends);

            $userId = $this->getUserId();

            $stmt = "UPDATE users SET friends=:friends WHERE id=:userId";
            return $db->execute($stmt, [":friends" => $friends, ":userId" => $userId]);
        }
        
    }

    public function sendMessage(array $message) {
        /*
        message ---|
                   v
                - senderId
                - senderUn
                - subject
                - content
        */

        global $db;

        $stmt = "INSERT INTO messages (`senderId`, `senderUn`, `subject`, `content`, `recipientId`) VALUES (:senderId, :senderUn, :subject, :content, :recipientId)";
        return $db->execute($stmt, [
            ":senderId" => $message["senderId"],
            ":senderUn" => $message["senderUn"],
            ":subject" => $message["subject"],
            ":content" => $message["content"],
            ":recipientId" => $message["recipientId"]
        ]);
    }
    
    public function hasBC() {
        $expires = new DateTime($this->data["membership"]["bcExpires"]);
        $today = new DateTime();

        if ($expires < $today) {
            $this->takeBC();
            return false;
        }

        return $this->data["membership"]["bc"] == 1;
    }
    public function bcExpires(bool $inDays = false) {
        $expires = new DateTime($this->data["membership"]["bcExpires"]);
        if ($inDays) {
            $now = new DateTime;
            $diff = $now->diff($expires);

            return $diff->format("%R%a");
        }

        return $expires->format("n/j/Y");
    }
    public function isInviter() {
        return false; // temp
    }
    public function getForumPosts($limit = NULL, $count = false) {
        global $db;
        $stmt = "SELECT * FROM threads WHERE author=:userId ORDER BY postId DESC";
        $result;

        if ($limit) {
            $stmt .= " LIMIT $limit";
            $result = $db->execute($stmt, [
                ":userId" => $this->getUserId()
            ]);
        } else {
            $result = $db->execute($stmt, [
                ":userId" => $this->getUserId()
            ]);
        }

        if ($count) {
            return $result->rowCount();
        }

        if ($result->rowCount() == 0) {
            return 0;
        }

        $fetchedPosts = $result->fetchAll(PDO::FETCH_ASSOC);
        $posts = [];

        foreach ($fetchedPosts as $fetchedPost) {
            $post = new Thread($fetchedPost["postId"]);
            array_push($posts, $post);
        }

        return $posts;
    }
    public function getProfileViews($counted = true) {
        $profileViews = $this->data["user"]["pviews"];
        if (is_numeric($profileViews) && $profileViews == 0) {
            $profileViews = 'a:0:{};';
        }
        if ($counted) {
            return count(unserialize($profileViews));
        } else {
            return unserialize($profileViews);
        }
    }
    public function hasFavorite($id) {
        $favorites = $this->getData("user", "favorites");
        $invalid = ["b:0;", null, "0"];
        if (in_array($favorites, $invalid)) {
            return false;
        }
        return in_array($id, unserialize($this->getData("user", "favorites")));
    }
    public static function getBuxByUserId($userId) {
        global $db;
        $stmt = "SELECT boombux FROM users WHERE id=:userId";
        $result = $db->execute($stmt, [":userId" => $userId]);
                
        return $result->fetch(PDO::FETCH_ASSOC)["boombux"];
    }

    public function removeFavorite($id) {
        if ($this->hasFavorite($id)) {
            global $db;

            $favorites = $this->getData("user", "favorites");
            $favorites = unserialize($favorites);
            $index = array_search($id, $favorites);
            if ($index !== false) {
                unset($favorites[$index]);
            }
            $favorites = serialize($favorites);

            $stmt = "UPDATE items SET favorites=favorites - 1 WHERE itemId=:id";
            $db->execute($stmt, [":id" => $id]);

            $stmt = "UPDATE users SET favorites=:favorites WHERE id=:id";
            return $db->execute($stmt, [
                ":favorites" => $favorites,
                ":id" => $this->getUserId()
            ]);
        }
    }
    public function favoriteItem($id) {
        if (!$this->hasFavorite($id)) {
            global $db;
            
            $favorites = $this->getData("user", "favorites");
            $invalid = ["b:0;", null, "0"];
            if (in_array($favorites, $invalid)) {
                $favorites = array();
            } else {
                $favorites = unserialize($favorites);
            }

            array_push($favorites, $id);
            $favorites = serialize($favorites);

            $stmt = "UPDATE users SET favorites=:favorites WHERE id=:id";
            $db->execute($stmt, [
                ":favorites" => $favorites,
                ":id" => $this->getUserId()
            ]);

            $stmt = "UPDATE items SET favorites=favorites+1 WHERE itemId=:itemId";
            $db->execute($stmt, [
                ":itemId" => $id
            ]);
        }
    }
    public function getFavorites($type = false, $count = false) {
        global $db;
        $favorites = $this->getData("user", "favorites");
        $invalid = ["b:0;", null, "0"];
        if (in_array($favorites, $invalid)) {
            $favorites = serialize(array());
        }
        $favorites = unserialize($favorites);
        if ($type) {
            if ($type == "game") {
                $stmt = "SELECT * FROM items WHERE itemType=:itemType AND itemId=:id";
            } else {
                $stmt = "SELECT * FROM items WHERE catalogType=:itemType AND itemId=:id";
            }
            if ($count) {
                $countedFavorites = 0;

                foreach ($favorites as $favorite) {  
                    $result = $db->execute($stmt, [":itemType" => $type, ":id" => $favorite]);
                    if ($result->rowCount() > 0) {
                        $countedFavorites += 1;
                    }
                }

                return ($countedFavorites);
            }
            $favoritedArray = array();
            foreach ($favorites as $favorite) {  
                $result = $db->execute($stmt, [":itemType" => $type, ":id" => $favorite]);
                if ($result->rowCount() > 0) {
                    array_push($favoritedArray,$result->fetch(PDO::FETCH_ASSOC));
                }
            }
            return $favoritedArray;
        }
        return count($favorites);
    }
    public function getItems($type = false, $count = false, $checkIfWearing = false) {
        global $db;
        $char = array_intersect($this->getCharacter(), ["t-shirt", "shirt", "pants", "hat", "head", "face"]);
        $items = unserialize($this->getData("user", "items"));
        if ($type) {
            if ($type == "game") {
                $stmt = "SELECT * FROM items WHERE itemType=:itemType AND itemId=:id";
            } else {
                $stmt = "SELECT * FROM items WHERE catalogType=:itemType AND itemId=:id";
            }
            if ($count) {
                $countedItems = 0;

                foreach ($items as $item) {  
                    $result = $db->execute($stmt, [":itemType" => $type, ":id" => $item]);
                    if ($result->rowCount() > 0) {
                        if ($checkIfWearing) {
                            if (!in_array($item, $this->getWornItems(false))) {
                                $countedItems += 1;
                            }
                        } else {
                            $countedItems += 1;
                        }
                    }
                }

                return ($countedItems);
            }
            $itemsArray = array();
            foreach ($items as $item) {  
                $result = $db->execute($stmt, [":itemType" => $type, ":id" => $item]);
                if ($result->rowCount() > 0) {
                    if ($checkIfWearing) {
                        #print_r($char);
                        if (!in_array($item, $this->getWornItems(false))) {
                            array_push($itemsArray,$result->fetch(PDO::FETCH_ASSOC));
                        }
                    } else {
                        array_push($itemsArray,$result->fetch(PDO::FETCH_ASSOC));
                    }
                }
            }
            return $itemsArray;
        }
        return count($items);
    }
    public function getItems2() {
        $items = $this->data["user"]["items"];

        return $items;
    }
    public function hasItem($item) {
        $items = $this->getItems2();
        
        return in_array($item, unserialize($items));
    }
    public function removeItem($item) {
        $items = $this->getItems2();
        if ($this->hasItem($item)) {
            global $db;

            $items = unserialize($items);
            $index = array_search($item, $items);
            if ($index !== false) {
                unset($items[$index]);
            }
            $items = serialize($items);

            $stmt = "UPDATE users SET items=:items WHERE id=:id";
            $db->execute($stmt, [
                ":items" => $items,
                ":id" => $this->getUserId()
            ]);
        }
    }
    public function getTickets() {
        return $this->getData("user", "tix");
    }
    public function getBoombux() {
        return $this->getData("user", "boombux");
    }
    public function getWornItems($array = true) {
        global $db;
        $char = $this->getCharacter();
        $wornArray = array(); #, $char["shirt"], $char["pants"], $char["tshirt"]
        if (!empty($char["hat"])) {
            array_push($wornArray, $char["hat"]);
        }
        if (!empty($char["shirt"])) {
            array_push($wornArray, $char["shirt"]);
        }
        if (!empty($char["pants"])) {
            array_push($wornArray, $char["pants"]);
        }
        if (!empty($char["t-shirt"])) {
            array_push($wornArray, $char["t-shirt"]);
        }
        if (!empty($char["head"])) {
            array_push($wornArray, $char["head"]);
        }
        if (!empty($char["face"])) {
            array_push($wornArray, $char["face"]);
        }
        if (!empty($char["gear"])) {
            array_push($wornArray, $char["gear"]);
        }
        if (!$array) {
            return $wornArray;
        }
        $returnArray = array();
        foreach ($wornArray as $worn) {
            if (!empty($worn)) {
                $stmt = "SELECT * FROM items WHERE itemId=:itemId";
                $result = $db->execute($stmt, [":itemId" => (int)$worn]);
                $result = $result->fetch(PDO::FETCH_ASSOC);
                array_push($returnArray,$result);
            }
        }
        return $returnArray;
    }
    public function getStatus() {
        if ($this->isOnline()) {
            global $db;
            $stmt = "SELECT * FROM servers WHERE players > 0";
            $result = $db->execute($stmt);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $server) {
                $players = $server["playerTable"];
                if ($players !== "0" && $players !== "a:0:{};") {
                    $players = unserialize($players);
                    if (in_array($this->data["user"]["id"], $players)) {
                        $stmt = "SELECT * FROM items WHERE itemId=:gameId";
                        $result = $db->execute($stmt, [":gameId" => (int)$server["placeId"]]);
                        $result = $result->fetch(PDO::FETCH_ASSOC);
                        return htmlspecialchars(Helper::debugString($result["itemName"]));
                    }
                }
            }
            #will continue if player not found
            return "Website";
        } else {
            return $this->lastOnline();
        }
    }

    public function getPlayingServerId() {
        global $db;
        $stmt = "SELECT * FROM servers WHERE players > 0";
        $result = $db->execute($stmt);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $server) {
            $players = $server["playerTable"];
            if ($players !== "0" && $players !== "a:0:{};") {
                $players = unserialize($players);
                if (in_array($this->data["user"]["id"], $players)) {
                    return (int)$server["id"];
                }
            }
        }
    }

    public function isInGame() {
        return $this->isOnline() == true && $this->getStatus() != "Website";
    }

    public function getOnline() {
        if ($this->isOnline()) {
            return "Online";
        } else {
            return "Offline";
        }
    }
    public function timeSinceDaily() {
        global $db;
        $stmt = "SELECT * FROM economy WHERE `method`='daily' AND `user`=:userId ORDER BY `action` DESC LIMIT 1";
        $result = $db->execute($stmt, [":userId" => $this->data["user"]["id"]]);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $lastDaily = new DateTime($result["occured"]);
            $now = new DateTime();
            $diff = $now->diff($lastDaily);
            return $diff->days;
        }
        return 2;
    }
    public function giveItem($item, $countInteraction = true) {
        if (!$this->hasItem($item)) {
            $items = unserialize($this->getItems2());
            array_push($items, $item);
            $items = serialize($items);
            global $db;
            $stmt = "UPDATE users SET items=:items WHERE id=:id";
            $db->execute($stmt, [":items" => $items, ":id" => $this->getData("user","id")]);
            if ($countInteraction) {
                $stmt = "UPDATE items SET interactions = interactions + 1 WHERE itemId=:id";
                $db->execute($stmt, [":id" => $item]);
            }
        }
    }
    public function boombloxifyItem($item) {
        if (!$this->hasItem($item)) {
            return false;
        }

        global $db;
        $stmt = "SELECT boombloxifier FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $item]);
        if ($result->rowCount() == 0) {
            return false;
        }

        $boombloxifier = $result->fetch(PDO::FETCH_ASSOC)["boombloxifier"];
        if ($boombloxifier == 0) {
            return false;
        }

        $items = unserialize($this->getItems2());
        array_push($items, $boombloxifier);
        $items = serialize($items);

        $stmt = "UPDATE users SET items=:items WHERE id=:id";
        $db->execute($stmt, [":items" => $items, ":id" => $this->getData("user","id")]);
        $stmt = "UPDATE items SET interactions = interactions + 1 WHERE itemId=:id";
        $db->execute($stmt, [":id" => $item]);
    }
    public function changePassword($newPassword) {
        global $db;
        $stmt = "UPDATE users SET `password`=:newPassword WHERE id=:id";
        $db->execute($stmt, [":newPassword" => password_hash($newPassword, PASSWORD_BCRYPT), ":id" => $this->getData("user","id")]);
        return true;
    }
}
?>