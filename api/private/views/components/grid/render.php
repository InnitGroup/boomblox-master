<div id="MainPanel">
    <?php
    global $user;
    if (Server::isPost() && $user->hasPerms(3)) {
        $thumb = "";
        $error = "";
        if (isset($_POST['ctl$cphRoblox$ID']) && isset($_POST['ctl$cphRoblox$Type'])) {
            $id = $_POST['ctl$cphRoblox$ID'];
            $type = $_POST['ctl$cphRoblox$Type'];
            switch ($type) {
                case "Avatar":
                    global $db;
                    if (!$db->userExists($id)) {
                        $error = "User $id was not found";
                        break;
                    }

                    $renderedUser = new User($id);
                    $altHash = md5($renderedUser->getAlternateAppearance());
                    
                    $stmt = "DELETE FROM cdn WHERE altHash=:altHash";
                    $db->execute($stmt, [":altHash" => $altHash]);

                    $avatar = new Avatar($id);
                    $avatar->RequestThumbnail(540,660,"PNG",true,true);
                    $avatar->RequestThumbnail(500,500,"PNG",true,true);
                    $thumb = $avatar->RequestThumbnail(100,100,"JPG",true,true);
                    break;
                case "Asset":
                    if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/content/$id")) {
                        $error = "Asset file wasn't found on the server";
                        break;
                    }

                    $asset = new Asset($id);
                    $altHash = $asset->AltHash($_SERVER["DOCUMENT_ROOT"]."/content/".$id);

                    global $db;
                    $stmt = "DELETE FROM cdn WHERE altHash=:altHash";
                    $db->execute($stmt, [":altHash" => $altHash]);

                    if ($asset->getType() == "game") {
                        $asset->RequestThumbnail(420, 230, "PNG",true,true);
                    }

                    $stmt = "UPDATE items SET lastUpdate=:xnow WHERE itemId=:itemId";
                    $db->execute($stmt, [
                        ":xnow" => date("Y-m-d H:i:s"),
                        ":itemId" => $id
                    ]);
                    
                    $thumb = $asset->RequestThumbnail(250, 250, "PNG",true,true);
                
                    break;
            }
        }
    }
    ?>
    <h1>Render</h1>
    <p>Use this to re-render assets and avatars</p>
    <hr>
    <div style="margin:5px;">
        <label for="ctl$cphRoblox$ID">ID: </label>
        <input type="number" name="ctl$cphRoblox$ID" required>
    </div>
    <div style="margin:5px;">
        <label for="ctl$cphRoblox$Type">Type:</label>
        <select name="ctl$cphRoblox$Type" id="ctl$cphRoblox$Type">
            <option value="Avatar">Avatar</option>
            <option value="Asset">Asset</option>
        </select>
    </div>
    <br>
    <button onclick="javascript:__doPostBack('ctl$cphRoblox$Render', '')">Render</button>
    <?php if (!empty($error)): ?>
    <p style="color:red"><?=$error?></p>
    <?php endif; ?>
    <?php if (!empty($thumb)): ?>
    <hr>
    <p>Rendered!</p>
    <img src="<?=$thumb?>" style="height:250px">
    <?php endif; ?>
</div>