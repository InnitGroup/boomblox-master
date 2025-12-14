<?php
#made: 01/25/2025 @marsoc (before logged; said 'hi', no history of when it was made)
#last edit: 01/28/2025 @marsoc: reinstated ->Asset() from thumbs to ->RequestThumbnail()
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$thumb = new Thumbnail;
class Asset extends Base {
    private static $_assetId;
    private $user;
    private static $_assetType;
    public static $_itemType;
    private static $_status;
    public function __construct($assetId) {
        global $db;
        self::$_assetId = $assetId;
        $stmt = "SELECT * FROM `items` WHERE `itemId`=:itemId";
        $result = $db->execute($stmt, [":itemId" => $assetId]);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetch(PDO::FETCH_ASSOC);
            self::$_assetType = $fetched["itemType"];
            self::$_itemType = $fetched["catalogType"];
            self::$_status = $fetched["status"];
        }
    }
    public function getType() {
        return self::$_assetType;
    }
    private function GetScript($width=100,$height=100,$imageFormat="PNG") {
        $script = "";
        switch (self::$_assetType) {
            case "catalog":
                $lighting = "true";
                if (self::$_itemType == "Hat" || self::$_itemType == "Model") {
                    $script = "game:GetObjects('http://".domain."/content/".self::$_assetId."')[1].Parent = game.Workspace";
                } elseif (self::$_itemType == "Shirt" || self::$_itemType == "Pants") {
                    $script = "
                    local player = game.Players:CreateLocalPlayer(0)
                    player.CharacterAppearance = 'http://".domain."/api/private/xml/DefaultColors.xml;http://".domain."/Asset/?id=".self::$_assetId."'
                    player:LoadCharacter()
                    ";
                } elseif (self::$_itemType == "Head") {
                    $script = "
                    local player = game.Players:CreateLocalPlayer(0)
                    player:LoadCharacter()

                    local char = player.Character
                    local head = char.Head
                    head.BrickColor = BrickColor.new('White')
                    head.Mesh:Remove()
                    head.face:Remove()
                    game:GetObjects('http://".domain."/content/".self::$_assetId."')[1].Parent = head

                    local head2 = head:Clone()
                    head2.Parent = char
                    local mesh = head2.Mesh
                    mesh.Scale = Vector3.new(1.06, 1.06, 1.06)
                    mesh.TextureId = 'http://xoblog.dev/content/1010'

                    local head3 = head:Clone()
                    head3.Parent = char
                    head3.Mesh.Scale = Vector3.new(1.05, 1.05, 1.05)
                    head3.CFrame = head2.CFrame * CFrame.fromEulerAnglesXYZ(0, math.rad(180), 0)

                    char.Torso:Remove()
                    char['Left Arm']:Remove()
                    char['Left Leg']:Remove()
                    char['Right Arm']:Remove()
                    char['Right Leg']:Remove()
                    ";
                }
                break;
            case "game":
                $lighting = "false";
                $script .= "game:Load('http://".domain."/Data/Get.ashx?id=".self::$_assetId."')";
                break;
        }
        return $script." 
        return game:GetService('ThumbnailGenerator'):Boom('".$imageFormat."', ".$width.", ".$height.", ".$lighting.")";
    }
    private function TestScript($width=100,$height=100,$imageFormat="PNG") {
        return "
        game:Load(\"http://".domain."/content/snap.rbxl\")
        return game:GetService('ThumbnailGenerator'):Boom('".$imageFormat."', ".$width.", ".$height.", false)
        ";
    }
    public function RequestThumbnail($width=100,$height=100,$imageFormat="PNG",$upload=true,$ignoreCache=false) {
        if (self::$_itemType == "T-Shirt") {
            return $this->RequestTShirt();
        }
        global $db;
        $hasError = 0;

        $size = Helper::dimensions($width,$height);
        $script = $this->GetScript($width,$height,$imageFormat);
        $altHash = md5(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".self::$_assetId));
        $xml = Thumbnail::getXml($script);

        if (empty(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/content/".self::$_assetId))) {
            return Thumbnail::getUnavail($size);
        }

        if (!$ignoreCache) {
            if ($result = CDN::hashExists($altHash, $size, $imageFormat, $hasError)) {
                return $result;
            }
        }

        $response = Thumbnail::getCurl($xml);
        if ($response) {
            $base64 = Thumbnail::getBase64FromResponse($response);
            if (!$upload) {
                return $base64;
            }
            $hash = md5($base64.$size);
            $location = Thumbnail::getLocation();
            $path = $_SERVER['DOCUMENT_ROOT']."/cdn/".$location."/".$hash;
            if (!$hasError) {
                $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`) VALUES ('".$hash."', '".$altHash."', '".$size."', '".$imageFormat."', '".$location."',1)";
                if ($db->execute($sql)) {
                    if ($upload) {
                        Thumbnail::uploadRender($path, $base64);
                    }
                    return Thumbnail::getHashResult($location, $hash);
                } else {return Thumbnail::getUnavail($size);}
            } else {
                $sql = "UPDATE cdn SET `hash`='".$hash."', `error`=0 WHERE `altHash`='".$altHash."'";
                if ($db->execute($sql)) {
                    if ($upload) {
                        Thumbnail::uploadRender($path, $base64);
                    }
                    return Thumbnail::getHashResult($location, $hash);
                }
            }
        } else {
            $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`, `error`) VALUES ('unavail-".$size.".png', '".$altHash."', '".$size."', '".$imageFormat."', 't2',1, 1)";
            $db->execute($sql);
            return Thumbnail::getUnavail($size);
        }
    }
    public function GetThumbnail($width=48,$height=48,$imageFormat="PNG",$renderIfNone=false) {
        if (self::$_status == "blocked") {
            return "https://t2.".domain."/unapproved-250x250.png";
        }

        if (self::$_itemType == "T-Shirt" || self::$_itemType == "Decal") {
            return $this->GetClothing();
        } 
        $assetId = self::$_assetId;

        if (self::$_itemType == "Mesh") {
            return "https://t2.".domain."/Unknown-120x120-00000000000000000000000000000000.png";
        }

        if (self::$_itemType != "Model") {
            if (self::$_status == "pending") {
                return "https://t2.".domain."/pending-250x250.png";
            }
        } elseif (File::isLuaModel($_SERVER["DOCUMENT_ROOT"]."/content/".self::$_assetId)) {
            return "https://t2.".domain."/Lua-250x250.png";
        } elseif (File::isSkybox($_SERVER["DOCUMENT_ROOT"] . "/content/" . self::$_assetId)) {
            return Thumbnail::extractSkybox($_SERVER["DOCUMENT_ROOT"] . "/content/" . self::$_assetId);
        }
        
        global $db;
        $size = Helper::dimensions($width,$height);
        $altHash = $this->AltHash($_SERVER["DOCUMENT_ROOT"]."/content/".self::$_assetId);
        $sql = "SELECT * FROM cdn WHERE `altHash`='".$altHash."' AND `size`='".$size."' AND `format`='".$imageFormat."'";

        $result = $db->execute($sql);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            return Thumbnail::getHashResult($result["location"], $result["hash"]);
        } else {
            if ($renderIfNone) {
                $this->RequestThumbnail($width,$height,$imageFormat,true);
            } else {
                return Thumbnail::getUnavail($size);
            }
        }
    }
    public function GetTShirt() {
        if (self::$_status == "pending") {
            return "https://t2.".domain."/tpending-250x250.png";
        } elseif (self::$_status == "blocked") {
            return "https://t2.".domain."/unapproved-250x250.png";
        }
        $path = "/".self::$_assetId.".png";
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/cdn/t7/" .$path)) {
            return "https://t7.".domain.$path;
        } else {
            return "https://t2.".domain."/unavail-250x250.png";
        }
    }
    public function GetDecal() {
        if (self::$_status == "pending") {
            return "https://t2.".domain."/pending-250x250.png";
        } elseif (self::$_status == "blocked") {
            return "https://t2.".domain."/unapproved-250x250.png";
        }

        $path = "/cdn/t3/".self::$_assetId;
        if (empty(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/content/".self::$_assetId))) {
            return "https://t2.".domain."/unavail-250x250.png";
        }

        $file = File::getImageType($_SERVER["DOCUMENT_ROOT"] . $path);
        if (file_exists($file["FullPath"])) {
            return "https://t3.".domain."/".self::$_assetId.".".$file["Extension"];
        } else {
            return "https://t2.".domain."/unavail-250x250.png";
        }
    }
    public function RequestTShirt() {
        Tshirt::render(self::$_assetId);
        return "https://t7.".domain."/".self::$_assetId.".png";
    }
    public function GetClothing() {
        if (self::$_itemType == "T-Shirt") {
            return $this->GetTShirt();
        } elseif(self::$_itemType == "Decal") {
            return $this->GetDecal();
        }
        if (self::$_status == "pending") {
            return "https://t2.".domain."/pending-250x250.png";
        } elseif (self::$_status == "blocked") {
            return "https://t2.".domain."/unapproved-250x250.png";
        }
        $path = "/cdn/t7/".self::$_assetId.".png";
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path)) {
            return "http://".domain.$path;
        } else {
            return "https://t2.".domain."/unavail-250x250.png";
        }
    }
    public function AltHash($assetPath) {
        if (file_exists($assetPath)) {
            return md5(file_get_contents($assetPath));
        } else {
            #echo '<script>window.location.href = "/Error/Specific.aspx?ID=1"</script>';
        }
    }
}
#$asset = new Asset(2);
#echo '<img src="'.$asset->RequestThumbnail(250,250,"PNG").'">';
?>