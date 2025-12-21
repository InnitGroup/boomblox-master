<?php
# item data get and set
class Item {
    private $item;

    # item id
    private $id;

    # main constructor
    public function __construct(int $id) {
        global $db;
        $this->id = $id;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $id]);
        if ($result->rowCount() > 0) {
            $this->item = (object)$result->fetch(PDO::FETCH_ASSOC);
        }
    }

    # check whether an item exists by id or not
    public static function exists(int $id): bool {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $id]);
        return $result->rowCount() > 0;
    }

    # renames an item
    public function rename(string $name): Item {
        global $db;
        $date = date("Y-m-d H:i:s");
        if (strlen($name) <= 50) {
            $stmt = "UPDATE items SET itemName=:itemName, lastUpdate=:dateV WHERE itemId=:itemId";
            $db->execute($stmt, [":itemName" => Helper::debugString($name), ":itemId" => $this->id, ":dateV" => $date]);
            return $this;
        }
    }

    # describes an item
    public function description(string $desc): Item {
        global $db;
        $date = date("Y-m-d H:i:s");
        $stmt = "UPDATE items SET itemDescription=:itemDescription, lastUpdate=:dateV WHERE itemId=:itemId";
        $db->execute($stmt, [":itemDescription" => $desc, ":itemId" => $this->id, ":dateV" => $date]);
        return $this;
    }

    # makes an item onsale
    public function onsale(): Item {
        global $db;
        $date = date("Y-m-d H:i:s");
        $stmt = "UPDATE items SET onsale=1, lastUpdate=:dateV WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":dateV" => $date]);
        return $this;
    }

    # sets the privacy setting of an item
    public function privacy(int $type): Item {
        /*
        1: public
        2: friends-only
        3: private
        */

        global $db;
        $stmt = "UPDATE items SET access=:accessType WHERE itemId=:itemId";
        $db->execute($stmt, [":accessType" => $type, ":itemId" => $this->id]);
        return $this;
    }

    # makes an item offsale
    public function offsale(): Item {
        global $db;
        $date = date("Y-m-d H:i:s");
        $stmt = "UPDATE items SET onsale=0, lastUpdate=:dateV WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":dateV" => $date]);
        return $this;
    }

    # turns comments on or off
    public function toggleComments($comments): Item {
        global $db;
        $stmt = "UPDATE items SET commentsEnabled=:commentsEnabled WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":commentsEnabled" => (int)$comments]);
        return $this;
    }

    # attaches a price in bux for an item
    public function sellForBux(int $amount) {
        global $db;
        $date = date("Y-m-d H:i:s");
        $stmt = "UPDATE items SET priceInBoombux=:priceInBoombux, lastUpdate=:dateV WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":priceInBoombux" => (int)$amount, ":dateV" => $date]);
        return $this;
    }

    # attaches a price in tix for an item
    public function sellForTix(int $amount) {
        global $db;
        $date = date("Y-m-d H:i:s");
        $stmt = "UPDATE items SET priceInTix=:priceInTix, lastUpdate=:dateV WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $this->id, ":priceInTix" => (int)$amount, ":dateV" => $date]);
        return $this;
    }

    # returns the item object
    public function get(): object {
        return $this->item;
    }

    # calculates the marketplace fee of a purchasable item
    public static function marketplaceFee(int $price) {
        if ($price == 1) {return 0;}
        return $price == 0 ? "---" : ceil($price * 0.1);
    }

    # calculates how much you earn when someone buys an item
    public static function youEarn(int $price) {
        if ($price == 1) {return 1;}
        return $price == 0 ? "---" : ($price - self::marketplaceFee($price));
    }

    public function isCopylocked(): bool {
        global $db;
        $stmt = "SELECT onsale FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $this->id]);
        return $result->fetch(PDO::FETCH_ASSOC)["onsale"] == 2;
    }
}
?>