<?php
global $user;
$ads = $user->getAds();
$amount = count($ads);
?>

<div id="Body">
    <div class="SearchBar">
        <h4>You found an in-development page, wooo!</h4>
    </div>
    <div class="StandardBoxHeader" style="width: 880px; margin-top: 20px"><span>My User Ads</span></div>
    <div class="StandardBox" style="float: left;width: 880px">
        <div>For a detailed explanation of how advertising on ROBLOX works, check out the <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_AdHelp" href="http://wiki.roblox.com/index.php/How_Advertising_Works">How Advertising Works</a> article in the help section.</div>
        <?php if ($amount > 0): ?>
            <?php foreach ($ads as $ad): ?>
                <div style="width:100%; border: 2px #000 solid; padding: 5px; margin: 5px; display: flex; display: table; clear: both;">
                    <div style="width:23%; float: left;">
                        <span style="font-weight: bold; font-size: 13px;">Ad: <?=htmlspecialchars($ad->name())?></span>
                        <div style="text-align: center; width: 80%; height: 100px; position: relative; left: -15px;">
                            <img src="<?=$ad->getImage()?>" style="max-height: 100px; max-width: 80%; border: 1px #000 solid">
                        </div>
                        <p><a href="/Item.aspx?ID=<?=$ad->assetId()?>">Destination <?=htmlspecialchars($ad->name())?></a></p>
                    </div>
                    <div style="width:43%; float: left;">
                        <table class="stats">
                            <tr>
                                <td class="hed">Ad Performance Stats</td>
                            </tr>
                        </table>
                        <table class="stats">
                            <tr>
                                <td>Stats</td>
                                <td>Last Run</td>
                                <td>Total</td>
                            </tr>
                            <tr>
                                <td>Impressions</td>
                                <td><?=count($ad->last_impressions())?></td>
                                <td><?=$ad->impressions()?></td>
                            </tr>
                            <tr>
                                <td>Clicks</td>
                                <td><?=count($ad->last_clicks())?></td>
                                <td><?=$ad->clicks()?></td>
                            </tr>
                            <tr>
                                <td>CTR</td>
                                <td><?=$ad->last_ctr()?></td>
                                <td><?=$ad->ctr()?></td>
                            </tr>
                            <tr>
                                <td>Bid</td>
                                <td><?=$ad->last_bid()?></td>
                                <td><?=$ad->bid()?></td>
                            </tr>
                        </table>
                    </div>
                    <div style="width:33%; float: left;">
                        <span>Ad Status:</span><br><br>
                        <?php switch ($ad->status()): 
                            case "pending": ?>
                        <img src="/images/AdPending.png">
                        <p>Pending approval</p>
                        <p style="padding-left: 8px;"><span style="color:#dcdcdc;">Run Ad</span>
                            <?php break; 
                                case "rejected": ?>
                        <img src="/images/AdRejected.png">
                        <p>Rejected</p>
                        <p style="padding-left: 8px;"><span style="color:#dcdcdc;">Run Ad</span>
                            <?php break;
                                case "running": ?>
                        <img src="/images/AdRunning.png">
                        <p>Running</p>
                        <p style="padding-left: 8px;"><span style="color:#dcdcdc;">Run Ad</span>
                            <?php break;
                                case "stopped": ?>
                        <img src="/images/AdStopped.png">
                        <p>Not running</p>
                        <p style="padding-left: 8px;"><a href="/My/AdBuy.aspx?adId=<?=$ad->id()?>">Run Ad</a>
                            <?php break;
                                default: ?>
                        <img src="/images/AdPending.png">
                        <p>Pending approval</p>
                        <p style="padding-left: 8px;"><a disabled>Run Ad</a>
                            <?php break; endswitch; ?>
                        <br><a href="javascript:__doPostBack('ctl00$cphRoblox$RemoveAd', '<?=$ad->id()?>')">Remove</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
        <div class="NoResults">You do not own any ads</div>
        <?php endif; ?>
        <div class="blockheader" style="padding:10px;text-align: center;clear: both;">
            <span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_Pager"><span>Previous</span>&nbsp;<span>Next</span>&nbsp;</span>
        </div>
    </div>
    <br style="clear: both" />
</div>