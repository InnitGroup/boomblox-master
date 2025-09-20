<div id="MainPanel">
    <h1>Block Asset</h1>
    <p>Do not intentionally try to break this panel as it was made within 5 minutes.</p>
    <label>Asset ID: </label>
    <input type="number" name="ctl$cphRoblox$AssetID" value="<?=isset($_GET["AssetID"]) ? (int)$_GET["AssetID"] : ""?>"><br>
    <input type="submit" value="Block">
    <?php
    global $db, $user;
    if (Server::isPost()) {
        if (isset($_POST['ctl$cphRoblox$AssetID'])) {
            $assetId = $_POST['ctl$cphRoblox$AssetID'];
            if ($user->hasPerms(5)) {
                $stmt = "UPDATE items SET `status`='blocked',`lastUpdate`=:lastUpdate,`itemName`='[ Content Deleted ]' WHERE itemId=:itemId";
                $db->execute($stmt, [":itemId" => $assetId, ":lastUpdate" => date('Y-m-d H:i:s')]);
                echo "Successfully blocked!";
                if (isset($_GET["AssetID"]) && isset($_GET["AbuseID"])) {
                    $stmt = "SELECT * FROM reports WHERE `handled`=0 AND `abuse`=:assetId AND`id`=:abuseId";
                    $result = $db->execute($stmt, [":assetId" => $_GET["AssetID"], ":abuseId" => $_GET["AbuseID"]]);
                    if ($result->rowCount() > 0) {
                        $stmt = "UPDATE reports SET `handled`=1 WHERE `id`=:abuseId";
                        $db->execute($stmt, [":abuseId" => $_GET["AbuseID"]]);
                    }
                }
            }
        }
    }
    ?>
</div>