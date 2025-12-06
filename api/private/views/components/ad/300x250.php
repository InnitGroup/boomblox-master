<?php
$display = Ad::algorithm("300x250");
$display->addImpression();
$display->checkIfValid();

if (Server::isPost()) {
    if (!isset($_POST['ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton'])) {
        $awarded = new UserAd($_POST['ctl00$cphRoblox$BigUglyAd$UserAdDisplay$HiddenAdID']);
        $awarded->addClick(); ?>
        <script type="text/javascript">
        window.location.href = "/Item.aspx?ID=<?=$awarded->assetId()?>"
        </script>
        <?php
    }
}
?>

<div id="RobloxLargeRectangleAd">
	<div style="overflow: hidden;">
		<div id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_AdPanel" class="AdPanel" style="margin-top: 10px;">
			<input type="hidden" name="ctl00$cphRoblox$BigUglyAd$UserAdDisplay$HiddenAdID" id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_HiddenAdID" value="<?=$display->assetId()?>">
			<a id="ctl00_cphRoblox_BigUglyAd_UserAdDisplay_AdImage" title="<?=htmlspecialchars($display->name())?>" onclick="__doPostBack('ctl00$cphRoblox$BigUglyAd$UserAdDisplay$AdImage','')" style="display:inline-block;cursor:pointer;">
				<img src="<?=$display->getImage()?>" border="0" alt="<?=htmlspecialchars($display->name())?>">
			</a>
		</div>
		<a id="ctl00_cphRoblox_BigUglyAd_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$BigUglyAd$ReportUserAdButton','')">[ report ]</a>
	</div>
</div>