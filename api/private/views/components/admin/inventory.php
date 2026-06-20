<?php
global $user;
$inventoryOwner = new User($_GET["UserID"]);
$inventory = $inventoryOwner->getItems("hat");
$count = 0;

if (Server::isPost()) {
    if (!isset($_POST['ctl00$cphRoblox$RemoveItem'])) {
        exit;
    }

    $itemToRemove = (int)$_POST['ctl00$cphRoblox$RemoveItem'];
    if (!$inventoryOwner->hasItem($itemToRemove)) {
        exit;
    }
    
    $inventoryOwner->removeItem($itemToRemove);
    global $db;

    $stmt = "UPDATE items SET interactions = interactions - 1 WHERE itemId=:itemId";
    $db->execute($stmt, [":itemId" => $itemToRemove]);

    Discord::sendWebhookMessage("staff-logs", "{$user->getUsername()} removed item $itemToRemove from {$inventoryOwner->getUsername()}'s inventory");
    exit(Server::_self());
}
?>

<div id="MainPanel">
    <span><h1><a href="/Admi/Users/ModerateUser.aspx?UserID=<?=$inventoryOwner->getUserId()?>"><?=htmlspecialchars($inventoryOwner->getUsername())?>'s</a> inventory</h1> If you are caught abusing this feature, you will be demoted and punished on the spot.</span>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0" style="width:100%; text-align:center;">
        <tr>
        <?php foreach ($inventory as $item) {
            if ($count > 0 && $count % 4 == 0) {
                echo "</tr><tr>";
            }

            $asset = new Asset($item["itemId"]);
            $render = $asset->GetThumbnail(250, 250, "PNG");
        ?>
        
            <td>
                <form method="post">
                    <img src="<?=$render?>" style="width:100px"><br>
                    <span><?=htmlspecialchars($item["itemName"])?> : <?=$item["itemId"]?></span><br>
                    <input type="hidden" name="ctl00$cphRoblox$RemoveItem" value="<?=$item["itemId"]?>">
                    <input type="submit" name="ctl00$cphRoblox$RemoveItemButton" value="Remove Item">
                </form>
            </td>
        <?php
            $count++;
        } ?>
        </tr>
    </table>
</div>