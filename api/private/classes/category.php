<?php
class Category {
    private static array $categories = [
        "Building",            #0
        "Explosive",           #1
        "Hourglass",           #2
        "Melee",               #3
        "Music",               #4
        "Navigation",          #5
        "PowerUps",            #6
        "Ranged",              #7
        "Social",              #8
        "PersonalTransport"    #9
    ];

    public static function categoryName(int $categoryId): string {
        return self::$categories[$categoryId];
    }

    public static function categoryId(string $category): int {
        return array_search($category, self::$categories);
    }

    public static function assignCategory(int $itemId, string|int $category) {
        # logic to determine category id
        if (gettype($category) == "string") {
            $category = self::$categoryId($category);
        }

        global $db;
        $stmt = "SELECT gears FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $itemId]);
        $itemCategory = $result->fetch(PDO::FETCH_ASSOC)["gears"];

        if ($itemCategory == NULL || empty($itemCategory)) {
            $itemCategory = array($category);
        } elseif (@unserialize($itemCategory) == false) {
            $itemCategory = array($itemCategory);
        } else {
            $itemCategory = unserialize($itemCategory);
            array_push($itemCategory, $category);
        }

        $itemCategory = serialize($itemCategory);

        $stmt = "UPDATE items SET gears = :category WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":category" => $category,
            ":itemId" => $itemId
        ]);
    }

    public static function categorySet(int $itemId, string|int $category) {
        if (gettype($category) == "string") {
            $category = self::$categoryId($category);
        }

        global $db;
        $stmt = "SELECT gears FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $itemId]);
        $itemCategory = $result->fetch(PDO::FETCH_ASSOC)["gears"];

        if ($itemCategory == NULL || empty($itemCategory)) {
            $itemCategory = array();
        } elseif (@unserialize($itemCategory) == false) {
            $itemCategory = array($itemCategory);
        } else {
            $itemCategory = unserialize($itemCategory);
        }

        return in_array($category, $itemCategory);
    }

    public static function setCategories(int $itemId, array $categories) {
        global $db;

        $categories = serialize($categories);
        $stmt = "UPDATE items SET gears = :category WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":category" => $categories,
            ":itemId" => $itemId
        ]);
    }

    public static function setAllCategory(int $itemId) {
        global $db;
        $categories = [];
        for ($i = 0; $i < count(self::$categories); $i++) {
            array_push($categories, $i);
        }

        $categories = serialize($categories);
        $stmt = "UPDATE items SET gears = :category WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":category" => $categories,
            ":itemId" => $itemId
        ]);
    }

    public static function getCategories(int $itemId) {
        global $db;
        $stmt = "SELECT gears FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $itemId]);
        $itemCategory = $result->fetch(PDO::FETCH_ASSOC)["gears"];

        if ($itemCategory == NULL || empty($itemCategory)) {
            $itemCategory = array();
        } elseif (@unserialize($itemCategory) == false) {
            $itemCategory = array($itemCategory);
        } else {
            $itemCategory = unserialize($itemCategory);
        }

        return $itemCategory;
    }
};
?>