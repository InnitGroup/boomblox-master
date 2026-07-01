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
                    global $db, $user;
                    switch ($decrypted[2]) {
                        case "lbSubmit":
                            $name = $_POST['ctl00$cphRoblox$tbName'];
                            if (strlen($name) > 40) {
                                $name = substr($name, 0, 40);
                            }

                            if (empty($name) || empty(str_replace(" ", "", $name))) {
                                $name = "Unnamed Place";
                            }

                            if (isset($_POST['GenreButtons2'])) {
                                $assumedGenreId = (int)$_POST['GenreButtons2'];

                                if (Genre::genreCount() < $assumedGenreId || $assumedGenreId < 0) {
                                    return;
                                }

                                Genre::assignGenre($this->placeId, (int)$assumedGenreId);
                            }

                            
                            
                            if (isset($_POST['ctl00$cphRoblox$GearGenreButtons'])) {
                                $gearGenreButtons = $_POST['ctl00$cphRoblox$GearGenreButtons'];
                                if ($gearGenreButtons == 'rbAllowAllGenres') {
                                    Category::setAllCategory($this->placeId);
                                } elseif ($gearGenreButtons == 'rbAllowSpecificGenres') {
                                    $categories = [];
                                    if (isset($_POST['ctl00$cphRoblox$cbMelee'])) {
                                        array_push($categories, 3);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbRanged'])) {
                                        array_push($categories, 7);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbExplosives'])) {
                                        array_push($categories, 1);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbPowerups'])) {
                                        array_push($categories, 6);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbNavigation'])) {
                                        array_push($categories, 5);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbInstruments'])) {
                                        array_push($categories, 4);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbSocial'])) {
                                        array_push($categories, 8);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbBuilding'])) {
                                        array_push($categories, 0);
                                    }
                                    if (isset($_POST['ctl00$cphRoblox$cbPersonalTransport'])) {
                                        array_push($categories, 9);
                                    }

                                    Category::setCategories($this->placeId, $categories);
                                }
                            }
                            

                            $stmt = "UPDATE items SET itemName=:itemName, itemDescription=:itemDescription, access=:access, lastUpdate=:lastUpdate WHERE itemId=:itemId";
                            $db->execute($stmt, [
                                ":itemName" => Helper::debugString($name), 
                                ":itemDescription" => Helper::debugString($_POST['ctl00$cphRoblox$tbDescription']), 
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
                            $newVersion = Version::getNextVersion($this->placeId);
                            Version::logVersion($this->placeId, $newVersion, $user); #
                            Version::setVersion($this->placeId, $newVersion, $user);
                            break;
                        case 'MakeCurrent':
                            Version::makeCurrent($this->placeId, (int)$_POST["__EVENTARGUMENT"]);
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
        PageBuilder::addComponent($folder, "gears", $packed);
        PageBuilder::addComponent($folder, "reset");
        PageBuilder::addComponent($folder, "history");
        PageBuilder::addComponent($folder, "buttons");
    }
}
?>