<?php
$display = Ad::algorithm("728x90");
$display->addImpression();
$display->checkIfValid();

if (Server::isPost()) {
    if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton'])) {
        $awarded = new UserAd($_POST['ctl00$cphBannerAd$UserBanner$UserAdDisplay$HiddenAdID']);
        $awarded->addClick(); ?>
        <script type="text/javascript">
        window.location.href = "/Item.aspx?ID=<?=$awarded->assetId()?>"
        </script>
        <?php
    }
}
?>

<div id="AdvertisingLeaderboard">
	<div style="overflow: hidden;">
		<div id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_AdPanel" class="AdPanel">
			<input type="hidden" name="ctl00$cphBannerAd$UserBanner$UserAdDisplay$HiddenAdID" id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_HiddenAdID" value="<?=$display->assetId()?>">
			<a id="ctl00_cphBannerAd_UserBanner_UserAdDisplay_AdImage" title="<?=htmlspecialchars($display->name())?>" onclick="__doPostBack('ctl00$cphBannerAd$UserBanner$UserAdDisplay$AdImage','')" style="display:inline-block;cursor:pointer;">
				<img src="<?=$display->getImage()?>" border="0" alt="<?=htmlspecialchars($display->name())?>">
			</a>
		</div>
		<a id="ctl00_cphBannerAd_UserBanner_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphBannerAd$UserBanner$ReportUserAdButton','')">[ report ]</a>
	</div>
</div>