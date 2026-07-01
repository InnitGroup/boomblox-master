<?php

class EditItemManager {
    private $item;
    private $itemData;
    public function __construct() {
        global $user, $db;
        $itemId = $_GET["ID"] ?? 0;

        $currentId = $user->getData("user", "id");

        if (Item::exists($itemId)) {
            $this->item = new Item($itemId);
            $this->itemData = $this->item->get();
            if ($currentId !== $this->itemData->creatorId) {
                Server::_404();
            }
        } else {
            Server::_404();
        }
    }
    public function load() {
        global $theme;
        $item = $this->itemData;
        PageBuilder::addComponent("edititem", "item", compact("theme", "item"));
    }
    public function handle() {
        if (empty($_POST)) {
            return;
        }

        if ($_POST["__EVENTTARGET"] == 'ctl00$cphRoblox$lbCancel') {
            return header("Location: /Item.aspx?ID=".$this->itemData->itemId);
        }

        $name = trim($_POST['ctl00$cphRoblox$tbName'] ?? null);
        $desc = trim($_POST['ctl00$cphRoblox$tbDescription'] ?? null);
        $comments = isset($_POST['ctl00$cphRoblox$cbIsCommentsEnabled']);

        if ($name === '') {
            Error::throw("Item name cannot be empty.");
            return header("Location: " . htmlspecialchars($_SERVER['REQUEST_URI']));
        }

        $this->item
            ->rename($name)
            ->description($desc)
            ->toggleComments($comments);

        if (isset($_POST['ctl00$cphRoblox$cbGearCategory']) && $this->itemData->catalogType == "Gear") {
            Category::setGearCategory($this->itemData->itemId, (int)$_POST['ctl00$cphRoblox$cbGearCategory']);
        }

        if (isset($_POST['ctl00$cphRoblox$cbIsOnsale'])) {
            $robux = isset($_POST['ctl00$cphRoblox$PricingFieldRobux']) ? (int)$_POST['ctl00$cphRoblox$PricingFieldRobux'] : 0;
            $tickets = isset($_POST['ctl00$cphRoblox$PricingFieldTickets']) ? (int)$_POST['ctl00$cphRoblox$PricingFieldTickets'] : 0;

            if ($robux == 0 && $tickets == 0) {
                $this->item->offsale();
            }

            $this->item->onsale()
                ->sellForBux($robux)
                ->sellForTix($tickets);
        } else {
            $this->item->offsale();
        }

        if (isset($_POST['GenreButtons2'])) {
            $assumedGenreId = (int)$_POST['GenreButtons2'];

            if (Genre::genreCount() < $assumedGenreId || $assumedGenreId < 0) {
                return;
            }

            Genre::assignGenre($this->itemData->itemId, (int)$assumedGenreId);
        }
    }
}

?>