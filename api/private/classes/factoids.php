<?php

class Factoids {
    public static array $catalogAdjectives = [
        "fine-looking",
        "bombastic",
        "new",
        "dark",
        "bright",
        "super",
        "glorious",
        "comfortable",
        "dangerous",
    ];

    public static array $catalogNouns = [
        "tuxedo",
        "fiery",
        "football",
        "black",
        "white",
        "purple",
        "knight",
        "hoodie",
        "pwn"
    ];

    public static array $catalogQueries = [
        "tuxedo",
        "fire",
        "football",
        "black",
        "white",
        "purple",
        "knight",
        "hoodie",
        "pwn"
    ];

    public static function generateCatalogFactoid(string $catalogType) {
        $randomOption = rand(0, count(self::$catalogQueries));
        $adjective = self::$catalogAdjectives[$randomOption];
        $noun = self::$catalogNouns[$randomOption];
        $query = self::$catalogQueries[$randomOption];
        
        global $db;
        $stmt = "SELECT COUNT(*) FROM items WHERE catalogType=:catalogType AND itemName LIKE '%$query%'";
        $result = $db->execute($stmt, [":catalogType" => $catalogType]);
    }
};

?>