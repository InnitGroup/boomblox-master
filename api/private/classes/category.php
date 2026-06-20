<?php
class Category {
    private array $categories = [
        "Building",
        "Explosive",
        "Hourglass",
        "Melee",
        "Music",
        "Navigation",
        "PowerUps",
        "Ranged",
        "Social",
        "PersonalTransport"
    ];

    public static function categoryName(int $categoryId): string {
        return $this->categories[$categoryId];
    }

    public static function categoryId(string $category): int {
        return array_search($category, $this->categories);
    }

    public static function assignCategory(int $itemId, string|int $category) {
        # logic to determine category id
        if (gettype($category == "string")) {
            $category = $this->categoryId($category);
        }

        global $db;
        $stmt = "UPDATE items SET category = :category WHERE itemId=:itemId";
        return $db->execute($stmt, [
            ":category" => $category,
            ":itemId" => $itemId
        ]);
    }
};
?>