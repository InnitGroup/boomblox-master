<?php
$packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount");
if (isset($purchaseData)) {
    $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
}
?>

<div id="Body">
    <div id="ItemContainer">
        <div id="Item">
            <h2><?=htmlspecialchars($data->itemName)?></h2>
            <?=PageBuilder::addComponent("item", "details", $packed);?>
            <?=PageBuilder::addComponent("item", "tabs", $packed);?>
        </div>
        <div class="Ads_WideSkyScraper"></div>
        <div style="clear:both"></div>
        <?=PageBuilder::addComponent("item", "purchasemodal", $packed);?>
    </div>
</div>