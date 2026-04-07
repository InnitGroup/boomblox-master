<?php
$inventoryOwner = new User($_GET["UserID"]);
$inventory = $inventoryOwner->getItems("hat");
?>

<div id="MainPanel">
    <?php foreach ($inventory as $item) {
        $asset = new Asset($item["itemId"]);
        $render = $asset->GetThumbnail(100, 100, "PNG"); ?>
        <img src="<?=$render?>" style="width:32px">
        <span><?=htmlspecialchars($item["itemName"])?> : <?=$item["itemId"]?></span>
        <input type="submit" name="ctl00$cphRoblox$RemoveItemButton" value="Remove Item" id="ctl00_cphRoblox_RemoveItemButton">
        
    <?php } ?>
        
</div>