<div id="MainPanel">
    <div>
        <h1>Gift Award</h1>
        <p>This is to award all the owners of a gift the item that comes from it.</p>
        <br>
        <label>Gift ID:</label>
        <input type="text" name="ctl00$robloxCph$itemId" required>
        <br>
        <label>Result ID:</label>
        <input type="text" name="ctl00$robloxCph$resultId" required>
        <br>
        <input type="submit" value="Award">
        <br>
        <?php
        global $user, $db;

        if (Server::isPost() && $user->hasPerms(7)) {
            $pass = true;

            if (!isset($_POST['ctl00$robloxCph$itemId'])) {
                $pass = false;
            }

            if (!isset($_POST['ctl00$robloxCph$resultId'])) {
                $pass = false;
            }

            if ($pass) {
                $itemId = (int)$_POST['ctl00$robloxCph$itemId'];
                $resultId = (int)$_POST['ctl00$robloxCph$resultId'];
                
                foreach ($db->getAllUsers() as $userInfo) {
                    $userObj = new User($userInfo["id"]);
                    if ($userObj->hasItem($itemId)) {
                        $userObj->giveItem($resultId);
                    }
                }
            }
        }
        ?>
    </div>
</div>