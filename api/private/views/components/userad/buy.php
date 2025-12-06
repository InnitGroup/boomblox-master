<?php
global $theme, $user;
$adId = (int)$_GET["adId"];
$ad = new UserAd($adId);
?>

<div id="Body">
    <div class="SearchBar">
        <h4>You found an in-development page, wooo!</h4>
    </div>
    <h3 style="text-align: center;">Bid to Run an Ad</h3>
    <div>For a detailed explanation of how advertising on <?=Site::getThemeProperty("alias", $theme)?> works, check out the <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_AdHelp" href="http://wiki.roblox.com/index.php/How_Advertising_Works">How Advertising Works</a> article in the help section.</div>
    <img src="<?=$ad->getImage()?>">
    <div id="ctl00$cphRoblox$EstimatorPanel" style="padding-left: 5px; width: 200px; border: solid #000 1px; clear: both;">
        <h3>Traffic Estimator</h3>
        <p>This estimator uses data from ads run yesterday to guess how many impressions your ad will receive. <b>This is just a guess.</b> If other players spend a lot on ads today, you will see fewer impressions.</p>
        <br>
        <p style="color: Red; display: none;">Estimated Impressions: 0</p>
    </div>
    <div style="margin-top: 5px;">
        <span>Bid in Tix</span>
        <input type="text" name = "ctl00$cphRoblox$BidAmount" class="TextBox"><br>
        <input type="submit" name="ctl00$cphRoblox$AdPlaceBid" class="MediumButton" value="Place Bid">
        <input type="submit" name="ctl00$cphRoblox$Cancel" class="MediumButton" value="Cancel">
    </div>
</div>