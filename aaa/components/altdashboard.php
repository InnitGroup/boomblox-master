<div style="width:100%;height:50px;background-color:#FFFEF3;border-bottom:1px solid black;clear:both;margin-top:-12px;padding:4px;">
    <p>
        <a style="text-decoration:underline;" href="/Admi/Machines.aspx">Machines</a>: <b><?=CPU::getMachineUsagePct()?>%</b> of <b><?=CPU::getMachines()?></b>&nbsp;
        <a style="text-decoration:underline;" href="/Admi/Cores.aspx">Cores</a>: <b><?=CPU::getCpuUsagePct()?>%</b> in use of <b><?=CPU::getCPUs()?></b>.&nbsp;
        <b><?=Gameservers::countRunning()?></b> running, <b><?=Gameservers::countWaiting()?></b> waiting
        &nbsp;|&nbsp;
        <b><?=Gameservers::countTotalPlayers()?></b>a <a style="text-decoration:underline;" href="/Admi/Games/Default.aspx">players</a> in <b><?=Gameservers::countGames()?></b> <a href="/Admi/Games/Default.aspx">games</a>&nbsp;<b>(<?=Gameservers::playersToGameRatio()?>)</b>&nbsp;
        <b>x</b> <a style="text-decoration:underline;" href="/Admi/Thumbs.aspx">thumb requests</a>
        &nbsp;|&nbsp;
        <b><?=Admin::getReportsToReview(true)?></b> <a style="text-decoration:underline;" href="/Admig/Moderation/Default.aspx">abuse reports</a>,&nbsp;
        <b><?=Admin::getImagesToReview(true)?></b> <a style="text-decoration:underline;" style="text-decoration:underline;" href="/Admi/Moderation/AssetReview.aspx">images</a>,&nbsp;
        <b><?=Admin::getUsersToReview(true)?></b> <a style="text-decoration:underline;" href="/Admi/Users/ModerateUser.aspx">users</a>.&nbsp;
        <a style="text-decoration:underline;" href="/Default.aspx">Roblox</a> <a style="text-decoration:underline;" href="/Admi/Users/Find.aspx">FindUser</a>
    </p>
</div>