<?php
$display = Ad::algorithm("300x250");

if (!isset($display->isFallback)) {
	$display->addImpression();
	$display->checkIfValid();

	if (Server::isPost()) {
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && !empty($_POST['__EVENTARGUMENT'])) {
			$awarded = new UserAd((int)$_POST['__EVENTARGUMENT']);
			$awarded->addClick(); ?>
			<script type="text/javascript">
			window.location.href = "/Item.aspx?ID=<?=$awarded->assetId()?>"
			</script>
			<?php
		}
	}
} else {
	if (Server::isPost()) {
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && $_POST['__EVENTARGUMENT'] == "164") { ?>
			<script type="text/javascript">
			window.location.href = "/Item.aspx?ID=164"
			</script>
			<?php
		}
	}
}
?>

<?php if (isset($display->isFallback)): ?>
<div id="AdvertisingLeaderboard">
	<div style="overflow: hidden;">
		<div id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_AdPanel" class="AdPanel">
			<input type="hidden" name="ctl00$cphBannerAd$UserBanner$UserAdDisplay$HiddenAdID" id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_HiddenAdID" value="164">
			<a id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_AdImage" title="Play ROtris Now!" onclick="__doPostBack('ctl00$cphBannerAd$UserBanner$UserAdDisplay$AdImage','164')" style="display:inline-block;cursor:pointer;">
				<img src="<?=$display->src?>" border="0" alt="Play ROtris Now!">
			</a>
		</div>
	</div>
</div>
<?php else: ?>
<div id="RobloxLargeRectangleAd">
	<div style="overflow: hidden;">
		<div id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_AdPanel" class="AdPanel" style="margin-top: 10px;">
			<input type="hidden" name="ctl00$cphRoblox$BigUglyAd$UserAdDisplay$HiddenAdID" id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_HiddenAdID" value="<?=$display->assetId()?>">
			<a id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_AdImage" title="<?=htmlspecialchars($display->name())?>" onclick="__doPostBack('ctl00$cphRoblox$BigUglyAd$UserAdDisplay$AdImage','<?=$display->id()?>')" style="display:inline-block;cursor:pointer;">
				<img src="<?=$display->getImage()?>" border="0" alt="<?=htmlspecialchars($display->name())?>">
			</a>
		</div>
		<a id="ctl00_cphRoblox_BigUglyAd_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$BigUglyAd$ReportUserAdButton','')">[ report ]</a>
	</div>
</div>
<?php endif; ?>