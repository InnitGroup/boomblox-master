<?php
global $db, $user;
$adId = (int)$_GET["adId"];
$ad = new UserAd($adId);
?>

<div id="Body">
    <img src="<?=$ad->getImage()?>">
    <div id="ctl00$cphRoblox$EstimatorPanel" style="padding-left: 5px; width: 200px; border: solid #000 1px; clear: both;">
        <h3>Traffic Estimator</h3>
        <p>This estimator uses data from ads run yesterday to guess how many impressions your ad will receive. <b>This is just a guess.</b> If other players spend a lot on ads today, you will see fewer impressions.</p>
        <br>
    </div>
    <div style="margin-top: 5px;">
        <span style="">Bid in Tix</span>
        <input type="text" class="TextBox"><br>
        <input type="submit" class="MediumButton" value="Place Bid">
        <input type="submit" class="MediumButton" value="Cancel">
    </div>
</div>