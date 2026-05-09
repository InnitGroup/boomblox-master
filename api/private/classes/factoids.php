<?php

class Factoids {
    public static array $catalogAdjectives = [
        "fine-looking",
        "bombastic",
        "deadly",
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
        "assassin robes",
        "football jerseys",
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
        "assassin",
        "football",
        "black",
        "white",
        "purple",
        "knight",
        "hoodie",
        "pwn"
    ];

    public static function generateCatalogFactoid(string $catalogType) {
        $printableType = $catalogType == "shirt" ? "shirts" : "pants";
        $catalogId = $catalogType == "shirt" ? "11" : "12";

        $randomOption = rand(0, count(self::$catalogQueries) - 1);
        $adjective = self::$catalogAdjectives[$randomOption];
        $noun = self::$catalogNouns[$randomOption];
        $query = self::$catalogQueries[$randomOption];
        
        global $db;
        $stmt = "SELECT COUNT(*) FROM items WHERE catalogType=:catalogType AND itemName LIKE '%$query%'";
        $result = $db->execute($stmt, [":catalogType" => $catalogType]);
        $count = $result->fetch()["COUNT(*)"];

        # 0 fine-looking tuxedos are available in the pants section of the catalog
        # 0 deadly assassin robes are available in the shirts section of the catalog



        return "<b>$count</b> <a href='Catalog.aspx?m=BestSelling&amp;c=$catalogId&amp;t=PastWeek&amp;d=All&amp;q=$query'>" . $adjective . " <b>" . $noun . (str_contains($noun, " ") ? "" : " " . $printableType) . "</b></a> are available in the " . $printableType . " section of the catalog";
        #return $count . " " . $adjective . " " . $noun . (str_contains($noun, " ") ? "" : $catalogType) . " are available in the " . $catalogType . " section of the catalog";
    }
};

?>