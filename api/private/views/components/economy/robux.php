<?php
global $theme, $db;
?>

<div id="MainPanel">
    <h1><?=Site::getThemeProperty("currency", $theme)?> Adjustment</h1>
    <p>Utilize this panel to provide <?=Site::getThemeProperty("currency", $theme)?> to users for adjustment purposes</p>
    <hr>
    <p style="color:red">Do not abuse this or you will be banned and lose permissions</p>
    <div style="margin:5px">
        <label for="ctl$cphRoblox$Amount" required>Amount: </label>
        <input type="number" name="ctl$cphRoblox$Amount"><br><br>
        <label for="ctl$cphRoblox$Recipient" required>Recipient: </label>
        <input type="number" name="ctl$cphRoblox$Recipient"><br><br>
        <label for="ctl$cphRoblox$Reason">Reason: </label>
        <input type="text" name="ctl$cphRoblox$Reason" required><br><br>
        <input type="submit" value="Proceed">
        <?php
        $error = '';
        if (Server::isPost()) {
            global $user;
            if ($user->hasPerms(5)) {
                if (isset($_POST['ctl$cphRoblox$Amount']) && isset($_POST['ctl$cphRoblox$Reason']) && isset($_POST['ctl$cphRoblox$Recipient'])) {
                    $amount = (int)$_POST['ctl$cphRoblox$Amount'];
                    $reason = $_POST['ctl$cphRoblox$Reason'];
                    $recipient = (int)$_POST['ctl$cphRoblox$Recipient'];

                    if (empty(trim($reason))) {
                        $error = "Reason cannot be blank space";
                    }

                    if (!$db->userExists($recipient)) {
                        $error = "Receiving user does not exist";
                    }

                    if ($amount < 0 || $amount > 1500) {
                        $error = "You cannot give less than 0 or more than 1,000";
                    }

                    if (empty($error)) {
                        $stmt = "INSERT INTO adjustments (amount, reason, adjustee, adjuster, occured) VALUES (:amount, :reason, :adjustee, :adjuster, :occured)";
                        $db->execute($stmt, [
                            ":amount" => $amount,
                            ":reason" => $reason,
                            ":adjustee" => $recipient,
                            ":adjuster" => $user->getUserId(),
                            ":occured" => date("Y-m-d H:i;s")
                        ]);
                        $adjustee = new User($recipient);
                        $adjustee->giveBux((int)$amount);
                    }             
                }
            }
        }
        ?>
        <?php if (!empty($error)): ?>
            <p style="color:red"><?=$error?></p>
        <?php endif; ?>
    </div>
    <hr>
    <h1>Recent Adjustments</h1>
    <?php
    global $db;
    $stmt = "SELECT * FROM adjustments ORDER BY id ";
    $result = $db->execute($stmt);
    
    if ($result->rowCount() > 0):
        $adjustments = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($adjustments as $adjustment):
            $adjustee = new User($adjustment["adjustee"]);
            $adjuster = new User($adjustment["adjuster"]);
    ?>
    <p>R$ <?=number_format($adjustment["amount"])?> given to <?=$adjustee->getUsername()?> by <?=$adjuster->getUsername()?></p>
    <p>Reason: <?=htmlspecialchars($adjustment["reason"])?></p><br>
    <?php endforeach; else: ?>
    <p>No adjustments made yet</p>
    <?php endif; ?>
</div>