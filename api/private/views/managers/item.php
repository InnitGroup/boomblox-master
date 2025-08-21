<?php
class ItemManager {
    private $itemId;
    private $itemData;
    private $theme;
    private $commentData;
    private $commentCount;
    private $purchased = false;
    public function __construct($itemId, $theme) {
        $this->itemId = $itemId;
        $this->theme = $theme;
        $this->processItemType();
    }
    public function processItemType() {
        #var_dump($_POST);
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $this->itemId]);

        if ($result->rowCount() == 1) {
            $itemData = $result->fetch(PDO::FETCH_ASSOC);
            $this->itemData = $itemData;
        } else {
            Server::_404();
        }

        $stmt = "SELECT COUNT(*) FROM comments WHERE itemId=:itemId ORDER BY commentTime DESC";
        $result = $db->execute($stmt, [":itemId" => $this->itemId]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $this->commentCount = $fetched["COUNT(*)"];

        $stmt = "SELECT * FROM comments WHERE itemId=:itemId ORDER BY commentTime DESC LIMIT 10";
        if (isset($_POST['__EVENTARGUMENT']) && isset($_POST['__EVENTTARGET'])) {
            if ($_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$rbxTabbedInfoCommentaryTab$PageSelector_Next' || $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$rbxTabbedInfoCommentaryTab$PageSelector_Previous') {
                $newPage = (int)$_POST['__EVENTARGUMENT'];

                if ($newPage !== 1) {
                    $offset = ($newPage-1)*10;
                    $stmt .= " OFFSET ".$offset;
                }
            }
        }
        $result = $db->execute($stmt, [":itemId" => $this->itemId]);

        if ($result->rowCount() > 0) {
            $commentData = $result->fetchAll(PDO::FETCH_ASSOC);
            $this->commentData = $commentData;
        }

        if (isset($_POST['ctl00$cphRoblox$ProceedWithTicketsPurchaseButton'])) {
            if ($this->handlePurchase("tix")) {
                $this->purchased = true;
            }   
        }

        if (isset($_POST['ctl00$cphRoblox$ProceedWithRobuxPurchaseButton'])) {
            if ($this->handlePurchase("boombux")) {
                $this->purchased = true;
            }
        }

        if (isset($_POST['__EVENTTARGET'])) {
            switch ($_POST['__EVENTTARGET']) {
                case 'ctl00$cphRoblox$Comment':
                    $this->handleComment();
                    break;
                case 'ctl00$cphRoblox$Favorite':
                    $this->handleFavorite();
                    break;
                case 'ctl00$cphRoblox$RemoveFromInventoryButton':
                    $this->handleRemove();
                    break;
                #case 'ctl00$cphRoblox$ProceedWithTicketsPurchaseButton':
                #    $this->handlePurchase();
                #    break;
            }
        }
    }
    public function getTitle() {
        # Place Name by Creator Name - ROBLOX Places
        $typeMap = [
            "game" => "Places",
            "Hat" => "Hats",
            "Shirt" => "Shirts",
            "Pants" => "Pants",
            "T-Shirt" => "T-Shirts",
            "Model" => "Models",
            "Decal" => "Decals",
        ];
        if ($this->itemData["itemType"] == "catalog") {
            $type = $typeMap[$this->itemData["catalogType"]];
        } else {
            $type = $typeMap[$this->itemData["itemType"]];
        }
        return htmlspecialchars($this->itemData["itemName"])." by ".$this->itemData["creatorName"]." - ".Site::getThemeProperty("alias", $this->theme)." ".$type;
    }
    public function load() {
        switch ($this->itemData["itemType"]) {
            case "catalog":
                $this->loadItem();
                break;
            case "game":
                $this->loadPlace();
                break;
        }
    }
    public function handleComment() {
        global $db, $user;
        $content = $_POST['content'];
        $stmt = "INSERT INTO comments (itemId, commenter, commenterId, content, commentTime) VALUES (:itemId, :commenter, :commenterId, :content, :commentTime)";
        $db->execute($stmt, [
            ":itemId" => $_GET["ID"],
            ":commenter" => $user->getUsername(),
            ":commenterId" => $user->getUserId(),
            ":content" => $content,
            ":commentTime" => date('Y-m-d H:i:s')
        ]);

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
    public function handleRemove() {
        global $user;
        $user->removeItem((int)$_GET["ID"]);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
    public function handleFavorite() {
        global $user;
        $user->favoriteItem($_GET["ID"]);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
    public function handlePurchase($currencyType) {
        global $user;
        $data = (object)$this->itemData;

        if ($data->onsale == 1) {
            $creator = new User($data->creatorId);
            switch ($currencyType) {
                case "tix":
                    if ($user->getTickets() >= $data->priceInTix) {
                        $user->takeTix($data->priceInTix);
                        $creator->giveTix($data->priceInTix);
                        $user->giveItem($data->itemId);
                        return true;
                    }
                    break;
                case "boombux":
                    if ($user->getBoombux() >= $data->priceInBoombux) {
                        $user->takeBux($data->priceInBoombux);
                        $creator->giveBux($data->priceInBoombux);
                        $user->giveItem($data->itemId);
                        return true;
                    }
                    break;
            }
        }
    }
    public function loadItem() {
        $data = (object)$this->itemData;
        $commentData = $this->commentData;
        $commentCount = $this->commentCount;

        $roblosecurity = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
        $asset = new Asset($this->itemId);
        $creator = new Avatar($data->creatorId);
        $user = new User($roblosecurity);

        $publicView = $data->creatorId !== $roblosecurity;
        $creatorRender = $creator->GetThumbnail(500,500, "PNG");
        $assetRender = $asset->GetThumbnail(250,250,"PNG");

        $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount");

        if (isset($_POST["__EVENTTARGET"])) {
            global $theme;
            if ($_POST["__EVENTTARGET"] == 'ctl00$cphRoblox$PurchaseWithTicketsButton') {
                $purchaseData = [
                    "currencyName" => "Tickets",
                    "shortName" => "Tx",
                    "price" => $data->priceInTix
                ];
                $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
            }
            if ($_POST["__EVENTTARGET"] == 'ctl00$cphRoblox$PurchaseWithRobuxButton') {
                $purchaseData = [
                    "currencyName" => Site::getThemeProperty("currency", $theme),
                    "shortName" => Site::getThemeProperty("shortCurrency", $theme),
                    "price" => $data->priceInBoombux
                ];
                $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
            }
            if (isset($_POST['ctl00$cphRoblox$ProceedWithTicketsPurchaseButton'])) {
                $purchaseData = [
                    "currencyName" => "Tickets",
                    "shortName" => "Tx",
                    "price" => $data->priceInTix,
                    "purchased" => $this->purchased
                ];
                $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
            }
            if (isset($_POST['ctl00$cphRoblox$ProceedWithRobuxPurchaseButton'])) {
                $purchaseData = [
                    "currencyName" => Site::getThemeProperty("currency", $theme),
                    "shortName" => Site::getThemeProperty("shortCurrency", $theme),
                    "price" => $data->priceInBoombux,
                    "purchased" => $this->purchased
                ];
                $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
            }
        }

        
        PageBuilder::addComponent("item", "main", $packed);
    }
    public function loadPlace() {
        global $db;
        $placeId = $_GET["ID"];

        $commentData = $this->commentData;
        $commentCount = $this->commentCount;

        $stmt = "SELECT * FROM items WHERE itemId=:placeId";
        $result = $db->execute($stmt, [":placeId" => $placeId]);
        if ($result->rowCount() > 0) {
            $item = $result->fetch(PDO::FETCH_ASSOC);
            PageBuilder::addComponent("place", "main", compact("item", "commentData", "commentCount"));
        } else {
            Server::_404();
        }
    }
}
?>