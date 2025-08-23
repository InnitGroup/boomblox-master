<?php
class PlaceManager {
    private $theme;
    private $placeId;
    private $user;
    public function __construct($post, $theme, $placeId) {
        global $user;
        $this->theme = $theme;
        $this->user = $user;
        $this->placeId = $placeId;
        $this->validatePlaceId();
        $this->processPost();
    }
    public function processPost() {
        if (!empty($_POST)) {
            if (isset($_POST["__EVENTTARGET"])) {
                 if (str_contains($_POST["__EVENTTARGET"], "$")) {
                    $decrypted = explode("$", $_POST["__EVENTTARGET"]);
                    global $db;
                    switch ($decrypted[2]) {
                        case "lbSubmit":
                            $stmt = "UPDATE items SET itemName=:itemName, itemDescription=:itemDescription, access=:access, lastUpdate=:lastUpdate WHERE itemId=:itemId";
                            $db->execute($stmt, [
                                ":itemName" => $_POST['ctl00$cphRoblox$tbName'], 
                                ":itemDescription" => $_POST['ctl00$cphRoblox$tbDescription'], 
                                ":access" => 0, 
                                ":lastUpdate" => date('Y-m-d H:i:s'), 
                                ":itemId" => $this->placeId
                            ]);
                            if (isset($_POST['ctl00$cphRoblox$PlaceAccess'])) {
                                $access = $_POST['ctl00$cphRoblox$PlaceAccess'];
                                $stmt;
                                switch ($access) {
                                    case 'rbPrivateAccess':
                                        $stmt = "UPDATE items SET access=0 WHERE itemId=:itemId";
                                        break;
                                    case 'rbPublicAccess':
                                        $stmt = "UPDATE items SET access=1 WHERE itemId=:itemId";
                                        break;
                                    default:
                                        Server::_404();
                                        break;
                                }
                                $db->execute($stmt, [":itemId" => $this->placeId]);
                            }
                            if (isset($_POST['ctl00$cphRoblox$cbIsCopyProtected'])) {
                                $stmt = "UPDATE items SET onsale=0 WHERE itemId=:itemId";
                                $db->execute($stmt, [":itemId" => $this->placeId]);
                            } else {
                                $stmt = "UPDATE items SET onsale=2 WHERE itemId=:itemId";
                                $db->execute($stmt, [":itemId" => $this->placeId]);
                            }
                            break;
                        case "lbCancel":
                            break;
                        case "lbClosePopUp":
                            break;
                        case "dlPlaceTemplates":
                            $places = [
                                "ctl00" => "HappyHomeInBoombloxia",
                                "ctl01" => "EmptyBaseplate",
                                "ctl02" => "StartingBrickbattleMap"
                            ];
                            $chosenPlace = $places[$decrypted[3]];
                            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/" . $this->placeId, gzencode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/content/templates/".$chosenPlace)));
                            $asset = new Asset($this->placeId);
                            $asset->RequestThumbnail(420, 230, "PNG");
                            $asset->RequestThumbnail(250, 250, "PNG");
                            break;
                        default:
                            #Server::_404();
                            break;
                    }
                 } else {
                     Server::_404();
                 }
            }
         }
    }
    public function validatePlaceId() {
        if ($this->placeId == 0) {
            Server::_404();
        }
        if (!in_array($this->placeId, $this->user->getPlaces(true))) {
            Server::_404();
        }
    }

    public function placeData() {
        global $db;
        $stmt = "SELECT * FROM items WHERE `itemId`=:itemId";
        $result = $db->execute($stmt, [":itemId" => $this->placeId]);
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }

    #public function
    public function load() {
        $asset = new Asset($this->placeId);
        $folder = "editplace";
        $place = $this->placeData();
        $packed = compact("asset", "place");
        PageBuilder::addComponent($folder, "top");
        PageBuilder::addComponent($folder, "name", $packed);
        PageBuilder::addComponent($folder, "thumbnail", $packed);
        PageBuilder::addComponent($folder, "description", $packed);
        PageBuilder::addComponent($folder, "access", $packed);
        PageBuilder::addComponent($folder, "copyprotection", $packed);
        PageBuilder::addComponent($folder, "reset");
        PageBuilder::addComponent($folder, "buttons");
    }
}
?>