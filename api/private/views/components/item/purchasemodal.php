<?php
global $user;

if (isset($purchaseData)) {
    $shortName = $purchaseData["shortName"];
    $price = $purchaseData["price"];
    $currencyName = $purchaseData["currencyName"];
    if ($currencyName !== "Tickets") {
        $currencyName = "Robux";
        $balance = $user->getBoombux() - $price;
    } else {
        $balance = $user->getTickets() - $price;
    }
}

?>

<div id="ctl00_cphRoblox_ItemPurchasePopupPanel" class="modalPopup" style="z-index: 5; position: absolute; left: 38%; top: 25%; width: 27em; display: <?=isset($purchaseData) ? "block" : "none"?>">
    <div id="ctl00_cphRoblox_ItemPurchasePopupUpdatePanel">
        <?php if (isset($purchaseData) && !isset($_POST['ctl00$cphRoblox$ProceedWithTicketsPurchaseButton']) && !isset($_POST['ctl00$cphRoblox$ProceedWithRobuxPurchaseButton']) && !isset($_POST['ctl00$cphRoblox$ProceedWithPublicDomainPurchaseButton'])): ?>
        <div id="VerifyPurchase_<?=$currencyName?>" style="margin: 1.5em;">
            <h3>Purchase Item:</h3>
            <p>Would you like to purchase <?=$data->catalogType?> "<?=htmlspecialchars($data->itemName)?>" from <?=$data->creatorName?> for <?=$shortName == "Free" ? "Free" : "$shortName ". number_format($price)?>?</p>
            <?php if ($shortName !== "Free"): ?>
            <p>Your balance after this purchase will be <?=$shortName?> <?=number_format($balance)?>.</p>
            <?php endif; ?>
            <p><input type="submit" name="ctl00$cphRoblox$ProceedWith<?=$shortName == "Free" ? "PublicDomain" : $currencyName?>PurchaseButton" value="Buy Now!" onclick="document.getElementById('VerifyPurchase_<?=$currencyName?>').style.display = 'none';document.getElementById('ProcessPurchase_<?=$currencyName?>').style.display = 'block';" id="ctl00_cphRoblox_ProceedWithTicketsPurchaseButton" class="MediumButton" style="width:100%;"></p>
            <p><input type="submit" name="ctl00$cphRoblox$Cancel<?=$shortName == "Free" ? "PublicDomain" : $currencyName?>PurchaseButton" value="Cancel" onclick="$find('myBehavior1').hide();" id="ctl00_cphRoblox_Cancel<?=$currencyName?>PurchaseButton" class="MediumButton" style="width:100%;"></p>
        </div>
        <div id="ProcessPurchase_<?=$currencyName?>" style="margin: 2.5em auto; display: none;">
            <div id="Processing_<?=$currencyName?>" style="margin: 0 auto; text-align: center; vertical-align: middle;">
                <img id="ctl00_cphRoblox_Processing<?=$currencyName?>PurchaseIconImage" src="images/ProgressIndicator2.gif" align="middle" style="border-width:0px;">&nbsp;&nbsp;
                Processing transaction ...
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php if (isset($purchaseData) && !isset($_POST['ctl00$cphRoblox$ProceedWithTicketsPurchaseButton']) || isset($_POST['ctl00$cphRoblox$ProceedWithRobuxPurchaseButton']) || isset($_POST['ctl00$cphRoblox$ProceedWithPublicDomainPurchaseButton'])): ?>
<div id="ctl00_cphRoblox_ItemPurchasePopupPanel" class="modalPopup" style="background-color: black; border: solid 1px black; z-index: 3; width: 300px; height:210px; position: absolute; left: 38.5%; top: 26%; width: 27em; display: <?=isset($purchaseData) ? "block" : "none"?>">
</div>
<?php endif ?>

<?php 
if (isset($_POST['ctl00$cphRoblox$ProceedWithTicketsPurchaseButton']) || isset($_POST['ctl00$cphRoblox$ProceedWithRobuxPurchaseButton']) || isset($_POST['ctl00$cphRoblox$ProceedWithPublicDomainPurchaseButton'])) {
    if ($purchaseData["purchased"]) {
        PageBuilder::addComponent("item", "purchasecomplete", compact("data", "shortName", "price"));
    } else {
        PageBuilder::addComponent("item", "purchasefailed", compact("data", "shortName", "price"));
    }
} 
?>