<?php
class Genre {
    private static array $genres = [
        "All",       #0
        "Adventure", #1
        "Castle",    #2
        "City",      #3
        "Classic",   #4
        "Cthulu",    #5
        "Fantasy",   #6
        "FPS",       #7
        "Funny",     #8
        "LOL",       #9
        "ModernMilitary", #10
        "Ninja",     #11
        "Pirate",    #12
        "RPG",       #13
        "Scary",     #14
        "SciFi",     #15
        "Sci-Fi",    #16
        "SkatePark", #17
        "Sports",    #19
        "TownandCity",#20
        "Tutorial",  #21
        "War",       #22
        "WildWest"   #23
    ];

    public static array $genreTitles = [
        "All",
        "Adventure",
        "Castle",
        "City",
        "Classic",
        "Cthulu",
        "Fantasy",
        "FPS",
        "Funny",
        "LOL",
        "Modern Military",
        "Ninja",
        "Pirate",
        "RPG",
        "Scary",
        "Sci Fi",
        "Sci-Fi",
        "Skate Park",
        "Sports",
        "Town and City",
        "Tutorial",
        "War",
        "Wild West"
    ];

    public static function genreName(int $genreId): string {
        return self::$genres[$genreId];
    }

    public static function genreId(string $genre): int {
        return array_search($genre, self::$genres);
    }

    public static function assignGenre(int $itemId, int|string $genre) {
        # logic to determine genre id
        if (gettype($genre) == "string") {
            $genre = self::genreId($genre);
        }

        global $db;
        $stmt = "UPDATE items SET genre = :genre WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":genre" => $genre,
            ":itemId" => $itemId
        ]);
    }

    public static function getGenreTitle(int $itemId) {
        global $db, $theme;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $itemId]);

        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $genreId = $fetched["genre"];
        $creatorId = $fetched["creatorId"];
        $itemType = $fetched["itemType"];

        if ($creatorId == 1 && $itemType == "catalog" && $genreId == 0) {
            return Site::getThemeProperty("alias", $theme) . "ia Classic (All)";
        }

        return self::$genreTitles[$genreId];
    }

    public static function getGenre(int $itemId): int {
        global $db;
        $stmt = "SELECT genre FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $itemId]);

        return (int)$result->fetch(PDO::FETCH_ASSOC)["genre"];
    }

    public static function genreCount(): int {
        return count(self::$genres);
    }
};
?>