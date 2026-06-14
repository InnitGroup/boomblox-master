<?php
class Economy {
    public static function lastAction() {
        global $db;
        $stmt = "SELECT * FROM economy ORDER BY action DESC LIMIT 1";
        $result = $db->execute($stmt);
        $result = $result->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    public static function issueDaily($user) {
        if ($user->timeSinceDaily() > 1) {
            global $db;
            $userId = $user->getUserId();

            $stmt = "INSERT INTO economy (`user`, `amount`, `currency`, `method`) VALUES (:userId, 10, 1, 'daily')";
            $db->execute($stmt, [":userId" => $userId]);

            $stmt = "UPDATE users SET `tix`=`tix`+10 WHERE id=:userId";
            $db->execute($stmt, [":userId" => $userId]);

            if ($user->hasBC()) {
                $stmt = "INSERT INTO economy (`user`, `amount`, `currency`, `method`) VALUES (:userId, 15, 2, 'daily')";
                $db->execute($stmt, [":userId" => $userId]);
                $stmt = "UPDATE users SET `boombux`=`boombux`+15 WHERE id=:userId";
                $db->execute($stmt, [":userId" => $userId]);
            }

            if ($user->hasPerms(5)) {
                Admin::backupDatabase();
            }
        }
    }
    public static function getDailies($timespan) {
        global $db, $user;
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];

        $stmt = "SELECT * FROM economy WHERE user=:userId AND method='daily' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => $user->getUserId()]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function countDailies($dailies, $type = "currency") {
        switch ($type) {
            case "dailies":
                $dailyCount = 0;
                foreach ($dailies as $daily) {
                    $dailyCount += 1;
                }
                return $dailyCount;
            case "currency":
                $currencyCount = array("tix" => 0, "bux" => 0);
                foreach ($dailies as $daily) {
                    if ($daily["currency"] == 1) {
                        $currencyCount["tix"] += 10;
                    } elseif ($daily["currency"] == 2) {
                        $currencyCount["bux"] += 15;
                    }
                }
                $currencyCount["tix"] == 0 && $currencyCount["tix"] = "&nbsp;";
                $currencyCount["bux"] == 0 && $currencyCount["bux"] = "&nbsp;";
                return $currencyCount;
        }
    }
    public static function countPlaceIncome($timespan) {
        global $db, $user;    
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];
        
        $stmt = "SELECT * FROM economy WHERE user=:userId and method='visit' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => $user->getUserId()]);
        
        $income = array("tix" => 0, "bux" => 0);
        while ($visit = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($visit["currency"] == 1) {
                $income["tix"] += $visit["amount"];
            } elseif ($visit["currency"] == 2) {
                $income["bux"] += $visit["amount"];
            }
        }

        $income["tix"] == 0 && $income["tix"] = "&nbsp;";
        $income["bux"] == 0 && $income["bux"] = "&nbsp;";
        return $income;
    }

    public static function countSalesIncome($timespan) {
        global $db, $user;    
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];
        
        $stmt = "SELECT * FROM economy WHERE user=:userId and method='sale' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => $user->getUserId()]);

        $income = array("tix" => 0, "bux" => 0);
        while ($sale = $result->fetch(PDO::FETCH_ASSOC)) {
            if ($sale["currency"] == 1) {
                $income["tix"] += $sale["amount"];
            } elseif ($sale["currency"] == 2) {
                $income["bux"] += $sale["amount"];
            }
        }

        $income["tix"] == 0 && $income["tix"] = "&nbsp;";
        $income["bux"] == 0 && $income["bux"] = "&nbsp;";
        return $income;
    }

    public static function countTotal($timespan) {
        $total = array("tix" => 0, "bux" => 0);
        $total["tix"] = (int)self::countDailies(self::getDailies($timespan))["tix"]+(int)self::countPlaceIncome($timespan)["tix"]+(int)self::countSalesIncome($timespan)["tix"];
        $total["bux"] = (int)self::countDailies(self::getDailies($timespan))["bux"]+(int)self::countPlaceIncome($timespan)["bux"]+(int)self::countSalesIncome($timespan)["bux"];
        $total["tix"] == 0 && $total["tix"] = "&nbsp;";
        $total["bux"] == 0 && $total["bux"] = "&nbsp;";
        return $total;
    }

    public static function currentBux() {
        global $db;
        $stmt = "SELECT SUM(boombux) AS bux FROM users";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["bux"];
    }

    public static function aliveBux() {
        global $db;
        $stmt = "SELECT SUM(boombux) AS bux FROM users WHERE terminal=0";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["bux"];
    }

    public static function deadBux() {
        global $db;
        $stmt = "SELECT SUM(boombux) AS bux FROM users WHERE terminal=1";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["bux"];
    }

    public static function currentTix() {
        global $db;
        $stmt = "SELECT SUM(tix) AS tix FROM users";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["tix"];
    }

    public static function aliveTix() {
        global $db;
        $stmt = "SELECT SUM(tix) AS tix FROM users WHERE terminal=0";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["tix"];
    }

    public static function deadTix() {
        global $db;
        $stmt = "SELECT SUM(tix) AS tix FROM users WHERE terminal=1";
        $result = $db->execute($stmt);
        return $result->fetch(PDO::FETCH_ASSOC)["tix"];
    }

    public static function logSale($amount, $currency) {
        global $db, $user;
        $stmt = "INSERT INTO economy (user, amount, currency, method) VALUES (:userId, :amount, :currency, 'sale')";
        $db->execute($stmt, [
            ":userId" => $user->getUserId(),
            ":amount" => $amount,
            ":currency" => $currency
        ]);
    }

    public static function getSales($relativeTime) {
        global $db;

        $stmt = "SELECT * FROM economy WHERE method='sale' AND occured >= CURDATE() - INTERVAL :relativeTime DAY";
        $result = $db->execute($stmt, [":relativeTime" => $relativeTime]);
        return $result;
    }

    public static function countCirculatedBux($relativeTime) {
        global $db;

        $stmt = "SELECT SUM(amount) AS bux FROM economy WHERE method='sale' AND currency = 2 AND occured >= CURDATE() - INTERVAL :relativeTime DAY";
        $result = $db->execute($stmt, [":relativeTime" => $relativeTime]);
        return $result->fetch(PDO::FETCH_ASSOC)["bux"] ?? 0;
    }

    public static function countCirculatedTix($relativeTime) {
        global $db;

        $stmt = "SELECT SUM(amount) AS tix FROM economy WHERE method='sale' AND currency = 1 AND occured >= CURDATE() - INTERVAL :relativeTime DAY";
        $result = $db->execute($stmt, [":relativeTime" => $relativeTime]);
        return $result->fetch(PDO::FETCH_ASSOC)["tix"] ?? 0;
    }

    public static function buxSpentOnDate($date) {
        global $db;

        $stmt = "SELECT SUM(amount) AS bux FROM economy WHERE method='sale' AND currency = 2 AND occured=:xdate";
        $result = $db->execute($stmt, [":xdate" => $date]);
        return $result->fetch(PDO::FETCH_ASSOC)["bux"] ?? 0;
    }

    public static function tixSpentOnDate($date) {
        global $db;

        $stmt = "SELECT SUM(amount) AS tix FROM economy WHERE method='sale' AND currency = 1 AND occured=:xdate";
        $result = $db->execute($stmt, [":xdate" => $date]);
        return $result->fetch(PDO::FETCH_ASSOC)["tix"] ?? 0;
    }
}
?>