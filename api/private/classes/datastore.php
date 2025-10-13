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
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            return $fetched;
        }
        
    }

    public static function keyExists(string $key) {
        global $db;

        $stmt = "SELECT id FROM datastore WHERE `privateKey`=:privateKey";
        $result = $db->execute($stmt, [":privateKey" => $key]);
        
        return $result->rowCount() == 1;
    }

    public static function insertData(string $key, array $newData) {
        global $db;
        $datastore = self::get($key);
        $data = $datastore["data"] == "0" ? [] : unserialize($datastore["data"]);
        
        $data = array_replace_recursive($data, $newData);
        $data = serialize($data);

        $stmt = "UPDATE datastore SET `data`=:newData WHERE privateKey=:pKey";
        return $db->execute($stmt, [
            ":newData" => $data,
            ":pKey" => $key
        ]);
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