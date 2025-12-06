<?php
$display = Ad::algorithm("160x600");
$display->addImpression();

if (Server::isPost()) {
    if (isset($_POST['__EVENTTARGET'])) {
        $awarded = new UserAd($_POST['ctl00$cphRoblox$AsyncAd1$UserAdDisplay$HiddenAdID']);
        $awarded->addClick(); ?>
        <script type="text/javascript">
        window.location.href = "/Item.aspx?ID=<?=$awarded->assetId()?>"
        </script>
        <?php
    }
}
?>

<div class="Ads_WideSkyscraper">
    <div style="overflow: hidden;">
        <div id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdPanel" class="AdPanel">
            <input type="hidden" name="ctl00$cphRoblox$AsyncAd1$UserAdDisplay$HiddenAdID" id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_HiddenAdID" value="<?=$display->id()?>">
            <a id="ctl00_cphRoblox_AsyncAd1_UserAdDisplay_AdImage" title="<?=htmlspecialchars($display->name())?>" onclick="__doPostBack('ctl00$cphRoblox$AsyncAd1$UserAdDisplay$AdImage','')" style="display:inline-block;cursor:pointer;">
                <img src="<?=$display->getImage()?>" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=htmlspecialchars($display->name())?>">
            </a>
        </div>
        <a id="ctl00_cphRoblox_AsyncAd1_ReportUserAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$AsyncAd1$ReportUserAdButton','')">[ report ]</a>
    </div>
</div>