<?php
$display = Ad::algorithm("728x90");

if (!isset($display->isFallback)) {
	$display->addImpression();
	$display->checkIfValid();

	if (Server::isPost()) {
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && !empty($_POST['__EVENTARGUMENT'])) {
			if (UserAd::exists((int)$_POST['__EVENTARGUMENT']) && $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$HomePageBottomBanner$UserAd$AdImage') {
			$awarded = new UserAd((int)$_POST['__EVENTARGUMENT']);#
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
		if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton']) && $_POST['__EVENTARGUMENT'] == "164" && $_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$HomePageBottomBanner$UserAd$AdImage') { ?>
			<script type="text/javascript">
			window.location.href = "/Item.aspx?ID=164"
			</script>
			<?php
		}
	}
}
?>

<?php if (isset($display->isFallback)): ?>
<div id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_AdPanel" class="AdPanel">
    <input type="hidden" name="ctl00$cphBannerAd$HomePageBottomBanner$UserAdDisplay$HiddenAdID" id="ctl00_cphBannerAd_FrontBanner_UserAdDisplay_HiddenAdID" value="164">
    <a id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_AdImage" title="AdBannerTemplate" onclick="__doPostBack('ctl00$cphRoblox$HomePageBottomBanner$UserAd$AdImage','164')" style="display:inline-block;cursor:pointer;">
        <img src="<?=$display->src?>" border="0" alt="AdBannerTemplate" blankurl="http://t2-cf.roblox.com/blank-728x90.gif">
    </a>
    <a id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_ReportAdButton" title="click to report an offensive ad" class="BanishButtonOverlay" href="javascript:__doPostBack('ctl00$cphRoblox$HomePageBottomBanner$UserAd$ReportAdButton','')">[ report ]</a>
</div>
<?php else: ?>
<div id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_AdPanel" class="AdPanel">
    <input type="hidden" name="ctl00$cphBannerAd$HomePageBottomBanner$UserAdDisplay$HiddenAdID" id="ctl00_cphBannerAd_FrontBanner_UserAdDisplay_HiddenAdID" value="<?=$display->assetId()?>">
    <a id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_AdImage" title="AdBannerTemplate" onclick="__doPostBack('ctl00$cphRoblox$HomePageBottomBanner$UserAd$AdImage','<?=$display->id()?>')" style="display:inline-block;cursor:pointer;">
        <img src="<?=$display->getImage()?>" border="0" alt="AdBannerTemplate" blankurl="http://t2-cf.roblox.com/blank-728x90.gif">
    </a>
    <a id="ctl00_cphRoblox_HomePageBottomBanner_UserAd_ReportAdButton" title="click to report an offensive ad" class="BanishButtonOverlay" href="javascript:__doPostBack('ctl00$cphRoblox$HomePageBottomBanner$UserAd$ReportAdButton','')">[ report ]</a>
</div>
<?php endif; ?>