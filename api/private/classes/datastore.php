<?php
class Datastore {
    public static function new(int $placeId) {
        global $db;

        $privateKey = Helper::guid();
        $stmt = "INSERT INTO datastore (`privateKey`, `placeId`, `data`) VALUES (:privateKey, :placeId,  :storeData)";

        $storeData = serialize(array());

        return $db->execute($stmt, [
            ":privateKey" => $privateKey,
            ":placeId" => $placeId,
            ":storeData" => $storeData
        ]);
    }

    public static function get(string $key) {
        global $db;

        if (self::keyExists($key)) {
            $stmt = "SELECT * FROM datastore WHERE privateKey=:privateKey";
            $result = $db->execute($stmt, [":privateKey" => $key]);
            $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
            return $fetched;
        }
        
    }

    public static function keyExists(string $key) {
        global $db;

        $stmt = "SELECT id FROM datastore WHERE `privateKey`=:privateKey";
        $result = $db->execute($stmt, [":privateKey" => $key]);
        
        return $result->rowCount() == 1;
    }

    public static function insertData(string $key, string $newData) {
        global $db;
        if ($datastore = self::get($key)) {
            $data = $datastore["data"];
            $data = unserialize($data);
            $data = array_push($data, $newData);
            $data = serialize($data);

            $stmt = "UPDATE datastore SET `data`=:newData WHERE `privateKey`=:privateKey";
            return $db->execute($stmt, [
                ":newData" => $data,
                ":privateKey" => $key
            ]);
        }
    }

    public static function parseData(string $data): array {
        $result = [];

        if (preg_match('/\[(.*?)\]/', $data, $matches)) {
            $keyValuePairs = explode(';', $matches[1]);

            foreach ($keyValuePairs as $pair) {
                list($key, $value) = explode('=', $pair);
                $result[$key] = is_numeric($value) ? (int)$value : $value;
            }
        }

        if (!isset($result['user'])) {
            return [];
        }

        return $result;
    }

}
?>