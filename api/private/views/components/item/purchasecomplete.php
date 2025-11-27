<div id="ctl00_cphRoblox_ItemPurchasePopupPanel" class="modalPopup" style="z-index: 5; position: absolute; left: 38%; top: 25%; width: 27em; display: block">
    <div id="ctl00_cphRoblox_ItemPurchasePopupUpdatePanel">
        <div id="PurchaseSuccess" style="display:block;margin: 1.5em;">
            <h3>Purchase Complete</h3>
            <p>
                You have successfully purchased <?=$data->catalogType?> "<?=htmlspecialchars($data->itemName)?>" from <?=$data->creatorName?> for <?=$shortName == "Free" ? "Free" : ": $price."?>
            </p>
            <p>
                <a href="/Catalog.aspx">Continue Shopping</a>
            </p>
            <p>
                <a href="/My/Character.aspx">Customize Character</a>
            </p>
        </div>
        
    </div>
</div>
<div id="ctl00_cphRoblox_ItemPurchasePopupPanel" class="modalPopup" style="background-color: black; border: solid 1px black; z-index: 3; width: 300px; height:140px; position: absolute; left: 38.5%; top: 26%; width: 27em; display: block">
</div>