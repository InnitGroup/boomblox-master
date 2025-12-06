<?php
global $theme, $user;
$packed = compact("asset", "assetRender", "creatorRender", "data", "publicView", "user", "commentData");

if (isset($data->itemDescription)) {
    $description = $data->itemDescription;
} else {
    $description = "No description provided.";
}
?>

<div id="Details">
    <div id="Thumbnail">
        <a disabled="" title="<?=htmlspecialchars($data->itemName)?>" onclick="return false" style="display:inline-block;">
            <img src="<?=$assetRender?>" border="0" alt="<?=htmlspecialchars($data->itemName)?>" style="height:250px;width:250px;">
        </a>
    </div>
    <div id="Summary">
        <h3><?=Site::getThemeProperty("alias", $theme)?> <?=$data->catalogType?></h3>
        <?php
        if (!$user->hasItem($data->itemId) && $data->onsale == 1) {
            if ($data->priceInBoombux > 0) {
                $purchaseData = [
                    "currencyName" => ucfirst(strtolower(Site::getThemeProperty("currency", $theme))),
                    "shortName" => Site::getThemeProperty("shortCurrency", $theme),
                    "price" => $data->priceInBoombux
                ];

                PageBuilder::addComponent("item", "purchasepanel", compact("purchaseData"));
            }
            if ($data->priceInTix > 0) {
                $purchaseData = [
                    "currencyName" => "Tickets",
                    "shortName" => "Tx",
                    "price" => $data->priceInTix
                ];

                PageBuilder::addComponent("item", "purchasepanel", compact("purchaseData"));
            }
            if ($data->creatorId == 1 && $data->priceInTix == 0 && $data->priceInBoombux == 0 && $data->onsale == 1) {
                $purchaseData = [
                    "currencyName" => "PublicDomain",
                    "shortName" => "Free",
                    "price" => 0
                ];

                PageBuilder::addComponent("item", "purchasepanel", compact("purchaseData"));
            }
        }
        ?>
        <div id="Creator" class="Creator">
            <div class="Avatar">
                <a href="/User.aspx?ID=<?=$data->creatorId?>" title="<?=$data->creatorName?>" style="display:inline-block;cursor:pointer;">
                    <img src="<?=$creatorRender?>" border="0" alt="<?=$data->creatorName?>" blankurl="?" style="height:100px;width:100px;">
                </a>
            </div> Creator: <a href="/User.aspx?ID=<?=$data->creatorId?>"><?=$data->creatorName?></a>
        </div>
        <div id="LastUpdate"> Updated: <?=Helper::timeAgo($data->lastUpdate)?> </div>
        <div id="Favorited"> Favorited: <?=Helper::times($data->favorites)?> </div>
        <div>
            <div id="DescriptionLabel">Description:</div>
            <div id="Description"> <?=htmlspecialchars($description)?></div>
        </div>
        <div id="ReportAbuse">
            <div class="ReportAbusePanel">
                <span class="AbuseIcon">
                    <a href="AbuseReport/AssetVersion.aspx?ID=<?=$data->itemId?>&amp;ReturnUrl=/Item.aspx?ID=<?=$data->itemId?>">
                        <img src="/images/abuse.png" alt="Report Abuse" border="0">
                    </a>
                </span>
                <span class="AbuseButton">
                    <a href="AbuseReport/AssetVersion.aspx?ID=<?=$data->itemId?>&amp;ReturnUrl=/Item.aspx?ID=<?=$data->itemId?>"> Report Abuse </a>
                </span>
            </div>
        </div>
    </div>
    <div id="Actions">
        <a <?=$user->hasFavorite($_GET["ID"]) ? "disabled" : ""?> <?php if (!$user->hasFavorite($_GET["ID"])): ?> href="javascript:__doPostBack('ctl00$cphRoblox$Favorite', '')" <?php endif; ?>>Favorite</a>
    </div>
    <?php if (!$publicView): ?>
        <div id="Configuration">
            <a href="/My/Item.aspx?ID=<?=$data->itemId?>">Configure <?=isset($data->catalogType) && $data->catalogType == "Pants" ? "these" : "this"; ?> <?=$data->catalogType?></a>
        </div>
        <div id="Advertise">
            <a href="/My/NewUserAd.aspx?targetID=<?=$data->itemId?>">Advertise <?=isset($data->catalogType) && $data->catalogType == "Pants" ? "these" : "this"; ?> <?=$data->catalogType?></a>
        </div>
    <?php endif; ?>
    <?php if ($user->hasItem($data->itemId)): ?>
        <div id="ctl00_cphRoblox_ItemOwnershipPanel" style="clear:both;">
            <div id="Ownership" style="margin-top:10px;">
                <a id="ctl00_cphRoblox_RemoveFromInventoryButton" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$RemoveFromInventoryButton','')">Delete from My Stuff</a>
            </div>
        </div>
    <?php endif; ?>
    <div style="clear:both;"></div>
</div>