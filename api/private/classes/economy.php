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
            $stmt = "INSERT INTO economy (`user`, `amount`, `currency`, `method`) VALUES (:userId, 10, 1, 'daily')";
            $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
            $stmt = "UPDATE users SET `tix`=`tix`+10 WHERE id=:userId";
            $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
            if ($user->hasBC()) {
                $stmt = "INSERT INTO economy (`user`, `amount`, `currency`, `method`) VALUES (:userId, 15, 2, 'daily')";
                $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
                $stmt = "UPDATE users SET `boombux`=`boombux`+15 WHERE id=:userId";
                $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
            }
        }
    }
    public static function getDailies($timespan) {
        global $db;
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];
        $stmt = "SELECT * FROM economy WHERE user=:userId AND method='daily' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]); #":timespan" => $timespanLimit[$timespan]]);
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
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];
        global $db;
        $stmt = "SELECT * FROM economy WHERE user=:userId and method='visit' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $income = array("tix" => 0, "bux" => 0);
        foreach ($result as $visit) {
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
        $timespanLimit = [
            "d" => "LIMIT 1",
            "w" => "LIMIT 7",
            "m" => "LIMIT 30",
            "a" => ""
        ];
        global $db;
        $stmt = "SELECT * FROM economy WHERE user=:userId and method='sale' ORDER BY occured DESC ".$timespanLimit[$timespan];
        $result = $db->execute($stmt, [":userId" => ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"])]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $income = array("tix" => 0, "bux" => 0);
        foreach ($result as $sale) {
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
}
?>