<?php
class Recommender {
    private array $keywords = [];
    private Item $originalItem;

    public static function gatherKeywords(int $itemId): array | null {
        $commonWords = ["the", "a", "and", "or", "but", "in", "of", "to", "for", "with", "at", "by", "from", "up", "down", "this", "that", "he", "she", "I", "you", "they", "not", "very", "here"];
        $preparedItem = new Item($itemId);
        $item = $preparedItem->get();
        $name = $item->itemName;

        $scoredName = preg_replace("/[^A-Za-z]/", "_", $name); # gathering all alphanumeric words by replacing non alphanumeric characters with underscores
        $words = explode("_", $scoredName);                    # exploding all alphanumeric words by underscores

        foreach ($commonWords as $commonWord) {
            $wordFound = array_search($commonWord, $words);
            if ($wordFound) {
               unset($words[$wordFound]); 
            }
        }

        return array_values(array_filter($words));
    }

    public function generateRecommendations(): array {
        $item = $this->originalItem->get();
        if (empty($this->keywords)) {
            $this->keywords = self::gatherKeywords($item->itemId);
        }

        $recommendationLimit = 4;
        if ($item->itemType == "game") {
            $recommendationLimit = 3;
        }

        global $db;
        $recommendations = [];
        #print_r($this->keywords);

        do {
            foreach ($this->keywords as $index => $keyword) {
                $stmt = "SELECT itemId FROM items WHERE itemName LIKE :keyword AND NOT itemId = :currentId AND itemType = :itemType AND catalogType = :catalogType LIMIT 1";
                $result = $db->execute($stmt, [
                    ":keyword" => "%$keyword%",
                    ":currentId" => $item->itemId,
                    ":itemType" => $item->itemType,
                    ":catalogType" => $item->catalogType
                    ]);
                if ($result->rowCount() == 0) {
                    continue;
                }

                $fetched = $result->fetch(PDO::FETCH_ASSOC);
                $recommendations[] = new Item($fetched["itemId"]);
            }
        } while (count($recommendations) < $recommendationLimit);
        
        if (empty($recommendations)) {
            $recommendations = ["Error" => "No " . $item->itemType == "game" ? "places" : Helper::makePlural($item->catalogType) . " available to recommend."];
        }

        return $recommendations;
    }

    public function __construct(int $itemId, array $keywords = NULL) {
        $this->originalItem = new Item($itemId);

        if (!isset($keywords)) {
            $this->keywords = self::gatherKeywords($itemId);
        }
    }
};