<?php
class CharacterManager {
    private $requestType;
    private $requestData = ["type" => "Hat"];
    private $page = 1;
    private $user;
    private $paginator;
    private $idToItem = [
        2 => "T-Shirt",
        8 => "Hat",
        11 => "Shirt",
        12 => "Pants",
        17 => "Head",
        18 => "Face"
    ];
    private $attireIDs = [
        2, 8, 11, 12, 17, 18
    ];
    public function __construct($post) {
        $this->user = new User(ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]));
        #print_r($post);
        if (isset($_GET["AttireTypeID"])) {
            $attireId = (int)$_GET["AttireTypeID"];
            if (in_array($attireId, $this->attireIDs)) {
                $this->requestData["type"] = $this->idToItem[$attireId];
            }
        }
        if (!empty($post)) {
            $decryptedTarget = explode("$",$post["__EVENTTARGET"]);
            $this->requestType = $decryptedTarget[0] ?? null; # [RequestType]$Value
            switch ($this->requestType) {
                case "Color":
                    $rgb = substr($post["__EVENTARGUMENT"],4,-1); # trims 'rbg(', and ')'
                    if (Helper::isset($decryptedTarget[1])) {
                        $this->requestData = ["brickColor" => Helper::rgbToBrick($rgb), "bodyPart" => $decryptedTarget[1]]; # RequestType$[Value]
                        $this->processColorChange();
                    }
                    break;
                case "Paginator":
                    $pageData = explode("$", $post["__EVENTARGUMENT"]);
                    $this->requestData = ["page" => (int)$pageData[1]];
                    if (Helper::isset($pageData[1])) {
                        $this->page = (int)$pageData[1];
                    }
                    if (Helper::isset($pageData[2])) {
                        $this->requestData["type"] = htmlspecialchars($pageData[2]);
                    } else {
                        $this->requestData["type"] = "Hat";
                    }
                    break;
                case "Type";
                    $typeData = explode("$", $post["__EVENTARGUMENT"]);
                    if (Helper::isset($typeData[1])) {
                        $this->requestData = ["type" => htmlspecialchars($typeData[1])];
                    } else {
                        $this->requestData = ["type" => "Hat"];
                    }
                    break;
                case "Accoutrement":
                    $accData = explode("$", $post["__EVENTARGUMENT"]);
                    if (Helper::isset($accData[0]) && Helper::isset($accData[1]) && Helper::isset($accData[2])) {
                        $this->requestData = ["type" => $accData[0], "accoutrementType" => $accData[0], "accoutrementId" => $accData[1], "action" => $accData[2]];
                        $this->processAccoutrement();
                    }
                    break;
                case null:
            }
        }
        $this->paginator = new CharacterPaginator("Paginator", $this->page, ceil($this->user->getItems($this->requestData["type"],true)/8), $this->requestData["type"]);
    }
    public function processColorChange() {
        $bodyParts = ["head", "la", "ra", "torso", "ll", "rl"];
        $bodyPart = $this->requestData["bodyPart"];
        $brickColor = $this->requestData["brickColor"];
        
        if (!in_array($bodyPart, $bodyParts)) {
            exit(header("Location: /My/Character.aspx"));
        }

        global $db, $user;
        $stmt = "UPDATE users SET ";
        $stmt .= htmlspecialchars($bodyPart)."Color=:brickColor WHERE id=:id";
        $result = $db->execute($stmt, [":brickColor" => (int)$brickColor, ":id" => $user->getUserId()]);
        if ($result) {
            $render = new Avatar($user->getUserId());
            $render->RequestThumbnail(540,660,"PNG");
            $render->RequestThumbnail(500,500,"PNG");
            $render->RequestThumbnail(100,100,"JPG");
            exit(header("Location: /My/Character.aspx"));
        }
    }
    public function processAccoutrement() {
        global $db, $user;
        $types = ["hat", "shirt", "pants", "t-shirt", "head", "face"];
        $type = strtolower($this->requestData["accoutrementType"]);
        $id = $this->requestData["accoutrementId"];
        $action = $this->requestData["action"];

        if (!in_array($type, $types)) {
            exit(header("Location: /My/Character.aspx"));
        }

        if ($this->user->hasItem((int)$id)) { #'<script>javascript:alert("hi")</script>';
            $stmt = "UPDATE users SET ";
            $args = array();
            $asset = new Asset($id);
            if ($type == "Head" && $asset->catalogType !== "Head") {
                exit(header("Location: /My/Character.aspx"));
            }
            
            if ($type == strtolower($asset->catalogType()) || $asset->catalogType() == "Hat") {
                if ($action == "Wear") {
                    $stmt .= "`".htmlspecialchars($type)."`=:aId WHERE `id`=:uId"; # aId = accoutrementId, uId = userId
                    $args = [":aId" => (int)$id, ":uId" => $user->getUserId()];
                } elseif ($action == "Remove") {
                    $stmt .= "`".htmlspecialchars($type)."`=NULL WHERE `id`=:uId"; # aId = accoutrementId, uId = userId
                    $args = [":uId" => $user->getUserId()];
                }
                
                $result = $db->execute($stmt, $args);
                if ($result) {
                    $render = new Avatar($user->getUserId());
                    $render->RequestThumbnail(540,660,"PNG");
                    $render->RequestThumbnail(500,500,"PNG");
                    $render->RequestThumbnail(100,100,"JPG");
                    exit(header("Location: /My/Character.aspx"));
                }
            } else {
                #Discord::sendWebhookMessage("vcchat", "type not connected");
            }
        }
    }

    public function characterViewer() {
        global $user;
        $char = new Avatar($user->getUserId());
        PageBuilder::addComponent("character", "viewer", compact("char"));
    }

    public function colorChooserFrame() {
        $character = $this->user->getCharacter();
        PageBuilder::addComponent("character", "colorchooser", compact("character"));
    }

    public function getCreate() {
        if ($this->requestData["type"] == "Hat" || $this->requestData["type"] == "Head") {
            return '<span style="color: #cccccc">Create</span>';
        } else {
            return '<a href="/My/ContentBuilder.aspx?ContentType='.Helper::typeId($this->requestData["type"]).'">Create</a>';
        }
    }

    public function loadWardrobe() {
        $page = $this->page;
        $limit = 8;
        $items = $this->user->getItems($this->requestData["type"], false, true);
        $items = array_reverse($items);
        #print_r($items);
        $countedItems = 0;
        $result = '';
        if (count($items) > 0) {
            foreach ($items as $item) {
                $countedItems += 1;
                if ($countedItems > (($page-1)*$limit) && $countedItems < ($limit*$page)+1) {
                    $thumbnail = new Asset($item["itemId"]);
                    $result .= '
                    <td class="Asset" id="'.$item["itemId"].'">
                        <a class="WearItem" title="click to wear" href="javascript:__doPostBack(\'Accoutrement\', \''.htmlspecialchars($this->requestData["type"]).'$'.(int)$item["itemId"].'$Wear\')" onclick="wearItem(event)">[ wear ]</a>
                        <a href="/Item.aspx?ID='.$item["itemId"].'">
                        <img class="AssetThumbnail" src="'.$thumbnail->GetThumbnail(250,250,"PNG").'">
                        </a>
                        <div class="AssetName">
                            <a href="/Item.aspx?ID='.$item["itemId"].'">'.htmlspecialchars($item["itemName"]).'</a>
                        </div>
                        <div class="AssetDetails Label">
                            <span>Creator: <a href="/User.aspx?ID='.$item["creatorId"].'">'.$item["creatorName"].'</a></span>
                        </div>
                    </td>
                    ';
                    if ($countedItems % 4 == 0 && $countedItems !== ($page*$limit)) {
                        $result .= '</tr>';
                    }
                    if ($countedItems == ($page*$limit)-4) {
                        $result .= '<tr class="TileGroup">';
                    }
                }
            }
        } elseif (Helper::typeId($this->requestData["type"]) !== 0) {
            return Site::noResults("You do not own any ".Helper::makePlural($this->requestData["type"]));
        } else {
            exit(Server::_s404());
        }
        return $result;
    }

    public function loadPaginatorOld() {
        
        $items = $this->user->getItems($this->requestData["type"]);
        $pages = ceil($this->user->getItems($this->requestData["type"], true)/8);
        $result = '';
        if ($pages == 1) {
            $result .= '
            <span style="color:#dcdcdc;">First Previous</span>
            <span>1</span>
            <span style="color:#dcdcdc;">Next Last</span>
            ';
        }
        if ($pages > 1) {
            for ($i = $this->page; $i <= 6; $i++) {

            }
        }

        /*
        $result .= '
        <span style="color:#dcdcdc;">First Previous</span>
        <span>1</span>
        <a href="javascript:__doPostBack(\'Paginator\',\'Page$2\')">2</a>
        <a href="javascript:__doPostBack(\'Paginator\',\'Page$3\')">3</a>
        <a href="javascript:__doPostBack(\'Paginator\',\'Page$'.($this->page+1).'\')">Next</a>
        <a href="javascript:__doPostBack(\'Paginator\',\'Page$3\')">Last</a>
        ';
        */
        
        return $result;
    }

    public function attireCategoryChosen($category) {
        if (!Helper::isset($this->requestData["type"]) && $category == "Hat") {
            return 'class="AttireCategorySelector_Selected"';
        }
        if ($category == $this->requestData["type"]) {
            return 'class="AttireCategorySelector_Selected"';
        }
    }

    public function attireChooser() {
        echo '
        <div class="AttireChooser" style="margin-bottom:10px;">
			<h4>My Wardrobe</h4>
			<div class="HeaderPager">
				<div class="AttireCategory">
					<span><a '.$this->attireCategoryChosen("Head").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$Head\')">Heads</a> | <a '.$this->attireCategoryChosen("Face").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$Face\')">Faces</a> | <a '.$this->attireCategoryChosen("Hat").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$Hat\')">Hats</a> | <a '.$this->attireCategoryChosen("T-Shirt").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$T-Shirt\')">T-Shirts</a> | <a '.$this->attireCategoryChosen("Shirt").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$Shirt\')">Shirts</a> | <a '.$this->attireCategoryChosen("Pants").' href="javascript:__doPostBack(\'Type\',\'Accoutrement$Pants\')">Pants</a></span><br>    				                
					<span><a href="/Catalog.aspx?m=ForSale&c='.Helper::typeId($this->requestData["type"]).'&d=All">Shop</a>&nbsp;&nbsp;'.$this->getCreate().'</span>
				</div>
			</div>
			<table>
				<tbody>
					<tr class="TileGroup">
						'.$this->loadWardrobe().'
					</tr>
				</tbody>
			</table>
			<div class="FooterPager">
				<span>
                    '.$this->paginator->load().'
				</span>
			</div>
		</div>
        ';
    }

    public function accoutrements() {
        $items = $this->user->getWornItems();
        echo '
        <div class="Accoutrements">
			<h4>Currently Wearing</h4>
			<table>
				<tbody>
					<tr class="TileGroup">';
                        if (!empty($items)) {
                            foreach ($items as $item) {
                                $thumbnail = new Asset($item["itemId"]);
                                echo '
                                <td class="Asset" id="'.$item["itemId"].'">
                                <a class="RemoveItem" href="javascript:__doPostBack(\'Accoutrement\', \''.$item["catalogType"].'$'.$item["itemId"].'$Remove\')" onclick="wearItem(event)">&nbsp;[ remove ]&nbsp;</a>
                                <a href="/Item.aspx?ID='.$item["itemId"].'">
                                <img class="AssetThumbnail" src="'.$thumbnail->GetThumbnail(250,250,"PNG").'">
                                </a>
                                <div class="AssetName">
                                    <a href="/Item.aspx?ID='.$item["itemId"].'">'.htmlspecialchars($item["itemName"]).'</a>
                                </div>
                                <div class="AssetDetails Label">
                                    <span>Creator: <a href="/User.aspx?ID='.$item["creatorId"].'">'.$item["creatorName"].'</a></span>
                                </div>
                            </td>
                                ';
                            }
                        } else {
                            #https://www.youtube.com/watch?v=p5d0ammvUoo
                            echo Site::noResults("You are not wearing any items from your wardrobe.");
                        }
					echo '</tr>
				</tbody>
			</table>
			<div class="FooterPager">
				<span>
                    <span style="color:#dcdcdc;">First</span>
                    <span style="color:#dcdcdc;">Previous</span>
                    '; 
                    
                    if (!empty($items)) {
                        echo '<span>1</span>';
                    }

                    echo'
                    <span style="color:#dcdcdc;">Next</span>
                    <span style="color:#dcdcdc;">Last</span>
                </span>
			</div>
		</div>
        ';
    }
}
?>