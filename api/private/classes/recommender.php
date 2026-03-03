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

        return array_filter($words);
    }

    public function __construct(int $itemId, array $keywords = NULL) {
        $this->originalItem = new Item($itemId);

        if (!isset($keywords)) {
            $this->keywords = self::gatherKeywords($itemId);
        }
    }
};