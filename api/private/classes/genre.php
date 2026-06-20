<?php
class Genre {
    private array $genres = [
        "Adventure",
        "All",
        "Castle",
        "City",
        "Classic",
        "Cthulu",
        "Fantasy",
        "FPS",
        "Funny",
        "LOL",
        "ModernMilitary",
        "Ninja",
        "Pirate",
        "RPG",
        "Scary",
        "SciFi",
        "Sci-Fi",
        "SkatePark",
        "Sports",
        "TownandCity",
        "Tutorial",
        "War",
        "WildWest"
    ];

    public static function genreName(int $genreId): string {
        return $this->genres[$genreId];
    }

    public static function genreId(string $genre): int {
        return array_search($genre, $this->genres);
    }

    public static function assignGenre(int $itemId, string|int $genre) {
        # logic to determine genre id
        if (gettype($genre == "string")) {
            $genre = $this->genreId($genre);
        }

        global $db;
        $stmt = "UPDATE items SET genre = :genre WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":genre" => $genre,
            ":itemId" => $itemId
        ]);
    }
};
?>