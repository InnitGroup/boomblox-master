<div id="MainPanel">
    <div>
        <h1>Award Product</h1>
        <p>Staff have the ability to award products and provide reasoning.</p>
        <br>
        <label>User ID:</label>
        <input type="text" name="ctl00$robloxCph$userId" required>
        <br>
        <label>Item ID:</label>
        <input type="text" name="ctl00$robloxCph$itemId" required>
        <br>
        <label>Reason:</label>
        <input type="text" name="ctl00$robloxCph$reason" required>
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
                $itemId = $_POST['ctl00$robloxCph$itemId'];
                $reason = $_POST['ctl00$robloxCph$reason'];

                $stmt = "SELECT * FROM items WHERE itemId=:itemId";
                $result = $db->execute($stmt, [":itemId" => $itemId]);
                if ($result->rowCount() > 0) {
                    $recipient = new User($userId);
                    if ($recipient->giveItem($itemId)) { ?>
                        <b>Successfully awarded product!</b>
                    <?php 
                        $stmt = "INSERT INTO awards (giver, recipient, content, reason, awardedAt) VALUES (:giver, :recipient, :content, :reason, :awardedAt)";
                        $result = $db->execute($stmt, [
                            ":giver" => $user->getUserId(),
                            ":recipient" => $userId,
                            ":content" => $itemId,
                            ":reason" => $reason,
                            ":awardedAt" => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
        }
        ?>
    </div>
</div>