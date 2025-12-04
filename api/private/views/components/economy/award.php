<div id="MainPanel">
    <div>
        <h1>Award Product</h1>
        <p>Staff have the ability to award products and provide reasoning.</p>
        <br>
        <label>User ID or Username: <i>if using username, begin with <pre>u:</pre></i></label>
        <input type="text" name="ctl00$robloxCph$userId" <?=isset($_GET["UserID"]) ? "value='" . (int)$_GET["UserID"] . "'" : ""?> required>
        <br>
        <label>Item ID:</label>
        <input type="text" name="ctl00$robloxCph$itemId" <?=isset($_GET["ItemID"]) ? "value='" . (int)$_GET["ItemID"] . "'" : ""?> required>
        <br>
        <label>Reason:</label>
        <input type="text" name="ctl00$robloxCph$reason" <?=isset($_GET["Reason"]) ? "value='" . htmlspecialchars($_GET["Reason"]) . "'" : ""?> required>
        <br>
        <input type="submit" value="Award">
        <br>
        <?php
        global $user, $db;

        if (Server::isPost() && $user->hasPerms(7)) {
            $pass = true;
            if (!isset($_POST['ctl00$robloxCph$userId'])) {
                $pass = false;
            }

            if (!isset($_POST['ctl00$robloxCph$itemId'])) {
                $pass = false;
            }

            if (!isset($_POST['ctl00$robloxCph$reason'])) {
                $pass = false;
            }

            if ($pass) {
                $userId = $_POST['ctl00$robloxCph$userId'];

                if (str_starts_with($userId, "u:")) {
                    $username = substr($userId, 2);
                    $userId = User::getIdByName($username);
                }

                $itemId = $_POST['ctl00$robloxCph$itemId'];
                $reason = $_POST['ctl00$robloxCph$reason'];

                $stmt = "SELECT * FROM items WHERE itemId=:itemId";
                $result = $db->execute($stmt, [":itemId" => $itemId]);
                if ($result->rowCount() > 0) {
                    $recipient = new User($userId);
                    $recipient->giveItem($itemId);
                    echo '<b>Successfully awarded product!</b>';
                    $stmt = "INSERT INTO awards (giver, recipient, content, reason, awardedAt) VALUES (:giver, :recipient, :content, :reason, :awardedAt)";
                    $db->execute($stmt, [
                        ":giver" => $user->getUserId(),
                        ":recipient" => $userId,
                        ":content" => $itemId,
                        ":reason" => "Awarded: ".$reason,
                        ":awardedAt" => date("Y-m-d H:i:s")
                    ]);
                }
            }
        }
        ?>
    </div>
</div>