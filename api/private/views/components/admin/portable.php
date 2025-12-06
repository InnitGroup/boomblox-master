<div style="position:fixed;bottom:0;right:60px;height:300px;width:150px;z-index:2;background-color:#D4D0C7;border:1px solid black;clear:both;padding:5px;">
    <p style="margin:0 0 0 0;"><a href="/Admi/Cores.aspx">Machines:</a> <b><?=CPU::getMachineUsagePct()?>%</b> of <b><?=CPU::getMachines()?></b></p>
    <p style="margin:0 0 0 0;"><a href="/Admi/Cores.aspx">Cores:</a> <b><?=CPU::getCpuUsagePct()?>%</b> in use of <b><?=CPU::getCPUs()?></b></p>
    <p style="margin:0 0 0 0;"><b><?=Gameservers::countRunning()?></b> running, <b><?=Gameservers::countWaiting()?></b> waiting</p>
    <hr>
    <p style="margin:0 0 0 0;"><b><?=Gameservers::countTotalPlayers()?></b> <a href="/Admi/Grid/Games.aspx">players</a> in <b><?=Gameservers::countGames()?></b> <a href="/Admi/Grid/Games.aspx">games</a></p>
    <p style="margin:0 0 0 0;"><b>(<?=Gameservers::playersToGameRatio()?>)</b></p>
    <p style="margin:0 0 0 0;"><b>x</b> <a href="/Admi/Thumbs.aspx">thumb requests</a></p>
    <hr>
    <p style="margin:0 0 0 0;">
        <b><?=Admin::getReportsToReview(true)?></b> <a href="/Admi/Moderation/AbuseReports.aspx">abuse reports</a>,
        <b><?=Admin::getImagesToReview(true) + Admin::getAdsToReview()?></b> <a href="/Admi/Moderation/AssetReview.aspx">images</a>,
        <b><?=Admin::getUsersToReview(true)?></b> <a href="/Admi/Users/ModerateUser.aspx">users</a>,
    </p>
    <p style="margin:0 0 0 0;"><a href="/Default.aspx">Roblox</a> <a href="/Admi/Users/Find.aspx">FindUser</a></p>
</div>