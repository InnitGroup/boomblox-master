<?php
$display = Ad::algorithm("160x600");

if (!isset($display->isFallback)) {
	$display->addImpression();
	$display->checkIfValid();

	if (Server::isPost()) {
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && !empty($_POST['__EVENTARGUMENT'])) {
			if (UserAd::exists((int)$_POST['__EVENTARGUMENT']) && $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$AsyncAd1$UserAdDisplay$AdImage') {
			$awarded = new UserAd((int)$_POST['__EVENTARGUMENT']);
			$awarded->addClick(); ?>
			<script type="text/javascript">
			window.location.href = "/Item.aspx?ID=<?=$awarded->assetId()?>"
			</script>
			<?php
			}
		}
	}
} else {
	if (Server::isPost()) {
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && $_POST['__EVENTARGUMENT'] == "2021"  && $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$AsyncAd1$UserAdDisplay$AdImage') { ?>
			<script type="text/javascript">
			window.location.href = "/Item.aspx?ID=2021"
			</script>
			<?php
		}
	}
}
?>

<?php if (isset($display->isFallback)): ?>
<div class="Ads_WideSkyscraper">
    <div style="overflow: hidden;">
        <div id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdPanel" class="AdPanel">
            <input type="hidden" name="ctl00$cphRoblox$AsyncAd1$UserAdDisplay$HiddenAdID" id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_HiddenAdID" value="2021">
            <a id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdImage" title="Play ROtris Now!" onclick="__doPostBack('ctl00$cphRoblox$AsyncAd1$UserAdDisplay$AdImage','2021')" style="display:inline-block;cursor:pointer;">
                <img src="<?=$display->src?>" border="0" alt="Play ROtris Now!">
            </a>
        </div>
        <a id="ctl00_cphRoblox_AsyncAd1_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$AsyncAd1$ReportUserAdButton','')">[ report ]</a>
    </div>
</div>
<?php else: ?>
<div class="Ads_WideSkyscraper">
    <div style="overflow: hidden;">
        <div id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdPanel" class="AdPanel">
            <input type="hidden" name="ctl00$cphRoblox$AsyncAd1$UserAdDisplay$HiddenAdID" id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_HiddenAdID" value="<?=$display->assetId()?>">
            <a id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdImage" title="<?=htmlspecialchars($display->name())?>" onclick="__doPostBack('ctl00$cphRoblox$AsyncAd1$UserAdDisplay$AdImage','<?=$display->id()?>')" style="display:inline-block;cursor:pointer;">
                <img src="<?=$display->getImage()?>" border="0" alt="<?=htmlspecialchars($display->name())?>">
            </a>
        </div>
        <a id="ctl00_cphRoblox_AsyncAd1_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$AsyncAd1$ReportUserAdButton','')">[ report ]</a>
    </div>
</div>
<?php endif; ?>