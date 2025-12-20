<?php
$type = $item->catalogType;
$name = htmlspecialchars(Helper::debugString($item->itemName));
$desc = !empty($item->itemDescription) ? htmlspecialchars($item->itemDescription) : "No description available.";
$comments = $item->commentsEnabled == 1 ? "checked" : "";

$onsale = $item->onsale == 1 ? "checked" : "";
$onsalePanel = $item->onsale == 1 ? "display: block;" : "display: none;";

$tix = $item->onsale == 1 && $item->priceInTix > 0 ? $item->priceInTix : "";
$bux = $item->onsale == 1 && $item->priceInBoombux > 0 ? $item->priceInBoombux : "";
$forTix = $item->onsale == 1 && $item->priceInTix > 0 ? "checked" : "";
$forBux = $item->onsale == 1 && $item->priceInBoombux > 0 ? "checked" : "";
?>

<div id="Body">
    <div id="EditItemContainer">
        <div id="EditItem">
            <h2>Configure <?=$type?></h2>
            <div id="ItemName">
                <span class="Label">Name:</span>
                <br>
                <input name="ctl00$cphRoblox$tbName" type="text" value="<?=$name?>" maxlength="50" class="TextBox">
            </div>
            <div id="ItemDescription">
                <span class="Label">Description:</span>
                <br>
                <textarea name="ctl00$cphRoblox$tbDescription" rows="2" cols="20" class="MultilineTextBox" style="height:150px;"><?=$desc?></textarea>
            </div>
            <div class="Buttons">
                <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbSubmit','')">Update</a>&nbsp; <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbCancel','')">Cancel</a>
            </div>
            <div id="Comments">
                <fieldset title="Turn comments on/off">
                    <legend>Turn comments on/off</legend>
                    <div class="Suggestion"> Choose whether or not this item is open for comments. </div>
                    <div class="EnableCommentsRow">
                        <input type="checkbox" <?=$comments?> name="ctl00$cphRoblox$cbIsCommentsEnabled">
                        <label for="ctl00_cphRoblox_cbIsCommentsEnabled">Allow Comments</label>
                    </div>
                </fieldset>
            </div>
            <?php if ($item->catalogType !== "Model"): ?>
            <div id="SellThisItem">
                <fieldset title="Sell this Item">
                    <legend>Sell this Item</legend>
                    <div class="Suggestion"> Check the box below and enter a price if you want to sell this item in the <?=Site::getThemeProperty("alias", $theme)?> catalog. Uncheck the box to remove the item from the catalog. </div>
                    <div class="SellThisItemRow">
                        <input type="checkbox" <?=$onsale?> id="ctl00$cphRoblox$cbIsOnsale" name="ctl00$cphRoblox$cbIsOnsale">
                        <label for="ctl00_cphRoblox_cbIsOnsale">Sell this Item</label>
                    </div>
                    <div id="Pricing" style="<?=$onsalePanel?>">
                        <div id="Currency" style="margin-left:143px;">
                            <div class="PricingField_Robux" id="ctl01$cphRoblox$PricingFieldRobux">
                                <input type="checkbox" <?=$forBux?> id="ctl00$cphRoblox$SellForRobux"><label>for <?=Site::getThemeProperty("currency", $theme)?></label>
                            </div>
                            <div class="PricingField_Tickets" id="ctl01$cphRoblox$PricingFieldTickets">
                                <input type="checkbox" <?=$forTix?> id="ctl00$cphRoblox$SellForTickets"><label>for Tickets</label>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <div id="Price">
                            <div class="PricingLabel" style="margin-left:-18px;" id="ctl00$cphRoblox$pricingLabel"> Price:</div>
                            <div class="PricingField_Robux" id="ctl01$cphRoblox$PricingFieldRobux">
                                <span id="ctl00$cphRoblox$PricingFieldLabel"><?=Site::getThemeProperty("shortCurrency", $theme)?> </span>
                                <input id="ctl00$cphRoblox$PricingFieldRobux" name="ctl00$cphRoblox$PricingFieldRobux" value="<?=$bux?>" type="number" class="TextBox">
                            </div>
                            <div class="PricingField_Tickets" id="ctl01$cphRoblox$PricingFieldTickets">
                                <span id="ctl01$cphRoblox$PricingFieldLabel">Tx </span>
                                <input id="ctl00$cphRoblox$PricingFieldTickets" name="ctl00$cphRoblox$PricingFieldTickets" value="<?=$tix?>" type="number" class="TextBox">
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="margin-top:5px;">
                            <div class="PricingLabel" style="margin-left:-18px;" id="ctl01$cphRoblox$pricingLabel">
                                 Marketplace Fee @ 10%:<br>
                                <span id="ctl00$cphRoblox$PricingSuggestion" class="Suggestion">(minimum 1)</span>
                            </div>
                            <div class="PricingField_Robux">
                                <span id="ctl00$cphRoblox$marketplaceFeeLabel"><?=Site::getThemeProperty("shortCurrency", $theme)?> </span>
                                <span id="ctl00$cphRoblox$marketplaceFeeRobux"><?=Item::marketplaceFee((int)$bux)?></span>
                            </div>
                            <div class="PricingField_Tickets">
                                <span id="ctl01$cphRoblox$marketplaceFeeLabel">Tx </span>
                                <span id="ctl00$cphRoblox$marketplaceFeeTickets"><?=Item::marketplaceFee((int)$tix)?></span>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="margin-top:5px;">
                            <div class="PricingLabel" style="margin-left:-18px;"> You Earn:</div>
                            <div class="PricingField_Robux">
                                <span id="ctl02$cphRoblox$marketplaceFeeLabel"><?=Site::getThemeProperty("shortCurrency", $theme)?> </span>
                                <span id="ctl00$cphRoblox$earningsRobux"><?=Item::youEarn((int)$bux)?></span>
                            </div>
                            <div class="PricingField_Tickets">
                                <span id="ctl03$cphRoblox$marketplaceFeeLabel">Tx </span>
                                <span id="ctl00$cphRoblox$earningsTickets"><?=Item::youEarn((int)$tix)?></span>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <?php endif; ?>
            <div class="Buttons">
                <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbSubmit','')">Update</a>&nbsp; <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbCancel','')">Cancel</a>
            </div>
        </div>
        <?=Ad::generateAd("160x600")?>
    </div>
    <div style="clear:both;"></div>
</div>