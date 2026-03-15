<?php
#made: 02/05/2025 @marsoc
#last edit: 02/18/2025 @marsoc: optimization, moving certain pieces to Thumbnail
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
class Avatar extends Base {
    private static $_userId;
    private $user;
    public function __construct($userId) {
        self::$_userId = $userId;
        $this->user = new User($userId);
    }
    public function GetScript($width=100,$height=100,$imageFormat="PNG") {
        $head = $this->user->getHead() == 0 ? 2268 : $this->user->getHead();
        $face = $this->user->getFace() == 0 ? 1010 : $this->user->getFace();

        $script = "
        local player = game.Players:CreateLocalPlayer(0)
        player.CharacterAppearance = '{$this->user->getCharacterAppearance(true)}'
        player:LoadCharacter()
        local char = player.Character
        local head = char.Head
        head.Mesh:Remove()
        head.face:Remove()
        game:GetObjects('http://xoblog.dev/asset/?id=$head')[1].Parent = head

        local head2 = head:Clone()
        head2.Parent = char
        local mesh = head2.Mesh
        mesh.Scale = Vector3.new(1.03, 1.03, 1.03)
        mesh.TextureId = 'http://xoblog.dev/asset/?id=$face'

        local head3 = head:Clone()
        head3.Parent = char
        head3.Mesh.Scale = Vector3.new(1.02, 1.02, 1.02)
        head3.CFrame = head2.CFrame * CFrame.fromEulerAnglesXYZ(0, math.rad(180), 0)
        print('{$this->user->getUsername()}:{$this->user->getUserId()} being rendered')
        return game:GetService('ThumbnailGenerator'):Boom('$imageFormat', $width, $height, true)";

        #Discord::sendWebhookMessage("vcchat", $script);
        return $script;
    }
    private function TestScript($width=100,$height=100,$imageFormat="PNG") {
        
        $roxbox = "0, 0.0, 0.1";
        $roundy = "0, 0.03, 0.2";
        $cframe = $roundy;
        return "local player = game.Players:CreateLocalPlayer(0)
        player.CharacterAppearance = '".$this->user->getCharacterAppearance()."'
        print('".$this->user->getUsername().":".$this->user->getUserId()." being rendered')
        player:LoadCharacter()
        player.Character.Head.Mesh:Remove()
        player.Character.Head.face:Remove()
        player.Character.Head.Anchored = true
        player.Character.Torso.Anchored = true
        player.Character['Left Arm'].Anchored = true
        player.Character['Right Arm'].Anchored = true
        player.Character['Left Leg'].Anchored = true
        player.Character['Right Leg'].Anchored = true
        player.Character.Head.Transparency = 1
        local fakehead = Instance.new(\"Part\")
        fakehead.Name = \"fakehead\"
        fakehead.Anchored = true
        fakehead.Parent = player.Character
        fakehead.CFrame = player.Character.Head.CFrame
        fakehead.BrickColor = player.Character.Head.BrickColor
        game:GetObjects(\"http://xoblog.dev/content/test/Roundy\")[1].Parent = player.Character.fakehead
        local fake = Instance.new(\"Part\") 
        fake.Parent = game.Workspace.Player 
        fake.Size = Vector3.new(0.5,2,0.5)  
        fake.CFrame = game.Workspace.Player.Head.CFrame + Vector3.new(".$cframe.")
        fake.Transparency = 1 
        fake.Anchored = true
        local face = Instance.new(\"Decal\") 
        face.Parent = fake 
        face.Texture = \"rbxasset://textures/face.png\"
        fakehead.CFrame = fakehead.CFrame * CFrame.fromEulerAnglesXYZ(0,math.rad(180),0)
        
        return game:GetService('ThumbnailGenerator'):Boom('".$imageFormat."', ".$width.", ".$height.", true)";
    }
    public function RequestThumbnail($width=100,$height=100,$imageFormat="PNG",$upload=true,$ignoreCache=false) {
        global $db;
        $user = $this->user;
        $hasError = 0;

        $size = Helper::dimensions($width,$height);
        $script = $this->GetScript($width,$height,$imageFormat);
        $altHash = md5($user->getAlternateAppearance());
        $xml = Thumbnail::getXml($script);

        if (!$ignoreCache) {
            if ($result = CDN::hashExists($altHash, $size, $imageFormat, $hasError)) {
                return $result;
            }
        }
        
        $response = Thumbnail::getCurl($xml);
        if ($response) {
            if (Thumbnail::hasError($response)) {
                $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`, `error`) VALUES ('unavail-".$size.".png', '".$altHash."', '".$size."', '".$imageFormat."', 't2',".self::$_userId.", 1)";
                $db->execute($sql);
                return Thumbnail::getUnavail($size);
            }
            $base64 = Thumbnail::getBase64FromResponse($response);
            $hash = md5($base64);
            $location = Thumbnail::getLocation();
            $path = $_SERVER['DOCUMENT_ROOT']."/cdn/".$location."/".$hash;
            if (!$hasError) {
                $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`) VALUES ('".$hash."', '".$altHash."', '".$size."', '".$imageFormat."', '".$location."',".self::$_userId.")";
                if ($db->execute($sql)) {
                    if ($upload) {
                        Thumbnail::uploadRender($path, $base64);
                        if ($size !== "540x660") {
                            CDN::correspondingRenders($path,$altHash,self::$_userId,48,48);
                            CDN::correspondingRenders($path,$altHash,self::$_userId,64,64);
                        }
                    }
                    return Thumbnail::getHashResult($location, $hash);
                } else {return Thumbnail::getUnavail($size);}
            } else {
                $sql = "UPDATE cdn SET `hash`='".$hash."', `error`=0 WHERE `altHash`='".$altHash."'";
                if ($db->execute($sql)) {
                    if ($upload) {
                        Thumbnail::uploadRender($path, $base64);
                        if ($size !== "540x660") {
                            CDN::correspondingRenders($path,$altHash,self::$_userId,48,48);
                            CDN::correspondingRenders($path,$altHash,self::$_userId,64,64);
                        }
                    }
                    return Thumbnail::getHashResult($location, $hash);
                }
            }
        } else {
            $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`, `error`) VALUES ('unavail-".$size.".png', '".$altHash."', '".$size."', '".$imageFormat."', 't2',".self::$_userId.", 1)";
            $db->execute($sql);
            return Thumbnail::getUnavail($size);
        }
    }
    public function TestThumbnail($width=100,$height=100,$imageFormat="PNG",$scriptP=0) {
        #scripts: 0->normal, 1->test
        $user = $this->user;
        switch ($scriptP) {
            case 0:
                $script = $this->GetScript($width,$height,$imageFormat);
                break;
            case 1:
                $script = $this->TestScript($width,$height,$imageFormat);
                break;
        }
        #$script = $this->TestScript($width,$height,$imageFormat);
        $xml = Thumbnail::getXml($script);
        $response = Thumbnail::getCurl($xml);
        if ($response) {
            return '<img src="data:image/png;base64,'.Thumbnail::getBase64FromResponse($response).'">';
        }
    }
    public function GetThumbnail($width=48,$height=48,$imageFormat="PNG",$renderIfNone=false) {
        $user = $this->user;
        global $db;
        $size = Helper::dimensions($width,$height);
        $altHash = md5($user->getAlternateAppearance());
        $sql = "SELECT * FROM cdn WHERE `altHash`='".$altHash."' AND `size`='".$size."' AND `format`='".$imageFormat."'";

        $result = $db->execute($sql);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            return Thumbnail::getHashResult($result["location"], $result["hash"]);
        } else {
            if ($renderIfNone) {
                $this->RequestThumbnail($width,$height,$imageFormat,true);
            } else {return Thumbnail::getUnavail($size);}
        }
    }
}
?>