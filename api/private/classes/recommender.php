<?php
class Recommender {
    private array $keywords = [];
    private Item $originalItem;

    public static function gatherKeywords(int $itemId): ?array {
        $commonWords = ["the", "a", "and", "or", "but", "in", "of", "to", "for", "with", "at", "by", "from", "up", "down", "this", "that", "he", "she", "i", "you", "they", "not", "very", "here"];

        $preparedItem = new Item($itemId);
        $item = $preparedItem->get();
        $name = strtolower($item->itemName);

        $scoredName = preg_replace("/[^a-z]/", "_", $name);

        $words = explode("_", $scoredName);

        $filtered = [];
        foreach ($words as $word) {
            if ($word === "") continue;
            if (in_array($word, $commonWords)) continue;
            $filtered[] = $word;
        }

        if (empty($filtered)) {
            $filtered = ["Wow"];
        }

        return array_values($filtered);
    }

    public function generateRecommendations(): array {
        global $db;

        $item = $this->originalItem->get();

        if (empty($this->keywords)) {
            $this->keywords = self::gatherKeywords($item->itemId);
        }

        $recommendationLimit = ($item->itemType === "game") ? 3 : 4;

        $recommendations = [];
        $seenIds = [];

        foreach ($this->keywords as $keyword) {
            if (count($recommendations) >= $recommendationLimit) break;

            if ($item->itemType == "catalog") {
                $stmt = "SELECT itemId FROM items
                     WHERE itemName LIKE :keyword
                     AND itemId != :currentId
                     AND itemType = :itemType
                     AND catalogType = :catalogType
                     ORDER BY RAND()
                     LIMIT 10";

                $result = $db->execute($stmt, [
                    ":keyword" => "%$keyword%",
                    ":currentId" => $item->itemId,
                    ":itemType" => $item->itemType,
                    ":catalogType" => $item->catalogType
                ]);

                if ($result->rowCount() == 0) {
                    $stmt = "SELECT itemId FROM items
                            WHERE itemType = :itemType
                            AND catalogType = :catalogType
                            ORDER BY RAND() LIMIT 10";
                    $result = $db->execute($stmt, [
                        ":itemType" => $item->itemType,
                        ":catalogType" => $item->catalogType
                    ]);
                }
            } else {
                $stmt = "SELECT itemId FROM items
                     WHERE itemName LIKE :keyword
                     AND itemId != :currentId
                     AND itemType = :itemType
                     ORDER BY RAND()
                     LIMIT 10";

                $result = $db->execute($stmt, [
                    ":keyword" => "%$keyword%",
                    ":currentId" => $item->itemId,
                    ":itemType" => $item->itemType
                ]);

                if ($result->rowCount() == 0) {
                    $stmt = "SELECT itemId FROM items
                            WHERE itemType = :itemType
                            ORDER BY RAND() LIMIT 10";
                    $result = $db->execute($stmt, [
                        ":itemType" => $item->itemType
                    ]);
                }
            }
            

            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            shuffle($rows);

            foreach ($rows as $row) {
                $id = $row["itemId"];
                if (in_array($id, $seenIds)) continue;

                $seenIds[] = $id;
                $recommendations[] = new Item($id);

                if (count($recommendations) >= $recommendationLimit) break 2;
            }
        }

        if (empty($recommendations)) {
            $recommendations = [
                "Error" => "No " . (
                    $item->itemType === "game"
                        ? "places"
                        : Helper::makePlural($item->catalogType)
                ) . " available to recommend."
            ];
        }

        return $recommendations;
    }

    public function build() {
        $recommendations = $this->generateRecommendations();
        $baseItem = $this->originalItem;
        PageBuilder::addComponent("recommender", "main", compact("recommendations", "baseItem"));
    }

    public function __construct(int $itemId, ?array $keywords = null) {
        $this->originalItem = new Item($itemId);

        if ($keywords !== null) {
            $this->keywords = $keywords;
        } else {
            $this->keywords = self::gatherKeywords($itemId);
        }
    }
}