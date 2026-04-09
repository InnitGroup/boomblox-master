<?php
$packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount");
if (isset($purchaseData)) {
    $packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData", "commentCount", "purchaseData");
}
?>

<div id="Body">
    <div id="ItemContainer">
        <div id="Item">
            <h2><?=htmlspecialchars(Helper::debugString($data->itemName))?></h2>
            <?php
            PageBuilder::addComponent("item", "details", $packed);
            $recommender = new Recommender($_GET["ID"]);
            $recommender->generateRecommendations();
            $recommender->build();
            PageBuilder::addComponent("item", "tabs", $packed);
            ?>
        </div>
        <div class="Ads_WideSkyScraper">
        <?=Ad::generateAd("160x600")?>
        </div>
        <div style="clear:both"></div>
        <?=PageBuilder::addComponent("item", "purchasemodal", $packed)?>
    </div>
</div>