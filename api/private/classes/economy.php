<?php
class Economy {
    private static function getUserId() {
        return ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
    }

    private static function getLimit($timespan) {
        return [
            "d" => 1,
            "w" => 7,
            "m" => 30,
            "a" => null
        ][$timespan] ?? 1;
    }

    public static function lastAction() {
        global $db;

        $stmt = "SELECT action FROM economy ORDER BY action DESC LIMIT 1";
        return $db->execute($stmt)->fetch(PDO::FETCH_ASSOC);
    }

    public static function issueDaily($user) {
        if ($user->timeSinceDaily() <= 1) {
            return;
        }

        global $db;
        $userId = self::getUserId();

        $db->beginTransaction();

        try {
            $db->execute(
                "INSERT INTO economy (`user`,`amount`,`currency`,`method`) 
                 VALUES (:userId, 10, 1, 'daily')",
                [":userId" => $userId]
            );

            $db->execute(
                "UPDATE users SET `tix` = `tix` + 10 WHERE id = :userId",
                [":userId" => $userId]
            );

            if ($user->hasBC()) {
                $db->execute(
                    "INSERT INTO economy (`user`,`amount`,`currency`,`method`) 
                     VALUES (:userId, 15, 2, 'daily')",
                    [":userId" => $userId]
                );

                $db->execute(
                    "UPDATE users SET `boombux` = `boombux` + 15 WHERE id = :userId",
                    [":userId" => $userId]
                );
            }

            if ($user->hasPerms(5)) {
                Admin::backupDatabase();
            }

            $db->commit();

        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    private static function countIncomeByMethod($method, $timespan) {
        global $db;

        $userId = self::getUserId();
        $limit = self::getLimit($timespan);

        $sql = "
            SELECT currency, SUM(amount) as total
            FROM economy
            WHERE user = :userId
              AND method = :method
            GROUP BY currency
            ORDER BY occured DESC
        ";

        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $rows = $db->execute($sql, [
            ":userId" => $userId,
            ":method" => $method
        ])->fetchAll(PDO::FETCH_ASSOC);

        $income = ["tix" => 0, "bux" => 0];

        foreach ($rows as $row) {
            if ($row["currency"] == 1) {
                $income["tix"] = (int)$row["total"];
            } elseif ($row["currency"] == 2) {
                $income["bux"] = (int)$row["total"];
            }
        }

        return $income;
    }

    public static function countDailies($timespan) {
        return self::countIncomeByMethod("daily", $timespan);
    }

    public static function countPlaceIncome($timespan) {
        return self::countIncomeByMethod("visit", $timespan);
    }

    public static function countSalesIncome($timespan) {
        return self::countIncomeByMethod("sale", $timespan);
    }

    public static function countTotal($timespan) {
        $daily = self::countDailies($timespan);
        $place = self::countPlaceIncome($timespan);
        $sales = self::countSalesIncome($timespan);

        return [
            "tix" => $daily["tix"] + $place["tix"] + $sales["tix"],
            "bux" => $daily["bux"] + $place["bux"] + $sales["bux"]
        ];
    }
}
?>