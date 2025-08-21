<?php
class Item {
    private $item;
    private $id;
    public function __construct(int $id) {
        global $db;
        $this->id = $id;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $id]);
        if ($result->rowCount() > 0) {
            $this->item = (object)$result->fetch(PDO::FETCH_ASSOC);
        }
    }
    public static function exists(int $id): bool {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $id]);
        return $result->rowCount() > 0;
    }
    public function rename(string $name): Item {
        global $db;
        $stmt = "UPDATE items SET itemName=:itemName WHERE itemId=:itemId";
        $db->execute($stmt, [":itemName" => $name, ":itemId" => $this->id]);
        return $this;
    }
    public function description(string $desc): Item {
        global $db;
        $stmt = "UPDATE items SET itemDescription=:itemDescription WHERE itemId=:itemId";
        $db->execute($stmt, [":itemDescription" => $desc, ":itemId" => $this->id]);
        return $this;
    }
    public function onsale(): Item {
        global $db;
        $stmt = "UPDATE items SET onsale=1 WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id]);
        return $this;
    }
    public function offsale(): Item {
        global $db;
        $stmt = "UPDATE items SET onsale=0 WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id]);
        return $this;
    }
    public function toggleComments($comments): Item {
        global $db;
        $stmt = "UPDATE items SET commentsEnabled=:commentsEnabled WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":commentsEnabled" => (int)$comments]);
        return $this;
    }
    public function sellForBux(int $amount) {
        global $db;
        $stmt = "UPDATE items SET priceInBoombux=:priceInBoombux WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":priceInBoombux" => (int)$amount]);
        return $this;
    }
    public function sellForTix(int $amount) {
        global $db;
        $stmt = "UPDATE items SET priceInTix=:priceInTix WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":priceInTix" => (int)$amount]);
        return $this;
    }
    public function get(): object {
        return $this->item;
    }
    public static function marketplaceFee(int $price) {
        if ($price == 1) {return 0;}
        return $price == 0 ? "---" : ceil($price * 0.1);
    }
    public static function youEarn(int $price) {
        if ($price == 1) {return 1;}
        return $price == 0 ? "---" : ($price - self::marketplaceFee($price));
    }
}
?>