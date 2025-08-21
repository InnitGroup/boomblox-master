<div id="MainPanel">
    <h1>Block Asset</h1>
    <p>Do not intentionally try to break this panel as it was made within 5 minutes.</p>
    <label>Asset ID: </label>
    <input type="number" name="ctl$cphRoblox$AssetID"><br>
    <input type="submit" value="Block">
    <?php
    global $db, $user;
    if (Server::isPost()) {
        if (isset($_POST['ctl$cphRoblox$AssetID'])) {
            $assetId = $_POST['ctl$cphRoblox$AssetID'];
            if ($user->hasPerms(5)) {
                $stmt = "UPDATE items SET `status`='blocked',`lastUpdate`=:lastUpdate WHERE itemId=:itemId";
                $db->execute($stmt, [":itemId" => $assetId, ":lastUpdate" => date('Y-m-d H:i:s')]);
                echo "Successfully blocked!";
            }
        }
    }
    ?>
</div>