<?php
$currencyName = $purchaseData["currencyName"];
if ($currencyName !== "Tickets") {
    $currencyName = "Robux";
}
$shortName = $purchaseData["shortName"];
$price = $purchaseData["price"];
?>

<?php if ($currencyName !== "PublicDomain"): ?>
<div id="ctl00_cphRoblox_<?=$currencyName?>PurchasePanel">
    <div id="<?=$currencyName?>Purchase">
        <div id="PriceIn<?=$currencyName?>"><?=$shortName?>: <?=number_format($price)?></div>
        <div id="BuyWith<?=$currencyName?>">
            <a id="ctl00_cphRoblox_PurchaseWithRobuxButton" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$PurchaseWith<?=$currencyName?>Button','')">Buy with <?=$shortName?></a>
        </div>
    </div>
</div>
<?php else: ?>
<div id="ctl00_cphRoblox_PublicDomainPurchasePanel">
    <div id="PublicDomainPurchase">
        <div id="PricePublicDomain">Free</div>
        <div id="BuyForFree">
            <a id="ctl00_cphRoblox_PurchaseForFreeButton" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$PurchaseForFreeButton','')">Take One!</a>
        </div>
    </div>		    
</div>
<?php endif; ?>