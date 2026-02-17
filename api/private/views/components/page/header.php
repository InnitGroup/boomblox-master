<?php
global $theme, $auth, $user;
if (Server::isPost()) {
	if ($_POST["__EVENTTARGET"] == "LoginStatus") {
		header("Location: /api/quicklogout.ashx");
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>
        <link rel="icon" href="/images/<?=Site::getThemeProperty("favicon", $theme)?>?v=<?=time()?>">
        <link rel="stylesheet" href="/CSS/AllCSS.ashx?v=<?=$theme?>">
        <link rel="stylesheet" href="/CSS/Ajax.css?t=<?=time()?>">
        <?php if (isset($hasAds)): ?>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4924425901885448" crossorigin="anonymous"></script>
            <?php endif; ?>
        <?php if (Server::isIE7()): ?>
            <script src="/ScriptResource.axd?v=<?=time()?>&d=ZGF0YTI="></script>
            <script src="https://code.jquery.com/jquery-1.7.0.min.js"></script>
        <?php else: ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script src="/ScriptResource.axd?v=<?=time()?>"></script>
        <?php endif; ?>

        <?php if (isset($jsList)): foreach ($jsList as $js): ?>
            <script src="/ScriptResource.axd?d=<?=base64_encode($js)?>"></script>
        <?php endforeach; endif; ?>
    </head>
    <body>
        <form name="aspnetForm" method="post" id="aspnetForm" <?=isset($enc) ? "enctype='".$enc."'" : ""?>>
            <input type="hidden" name="__EVENTARGUMENT">
            <input type="hidden" name="__EVENTTARGET">
            <input type="hidden" name="__VIEWSTATE" value="<?=Viewstate::generateViewState()?>">
            <div id="MasterContainer">
                <div id="Container">
                    <?=Ad::generateAd("728x90")?>
                    <div id="Header">
                        <div id="Banner">
                            <div id="Options">
                                <div id="Authentication">
                                    <span>
                                        Logged in as <?=$user->getData("user","username");?> | <a id="ctl00_lsLoginStatus" href="javascript:__doPostBack('LoginStatus','')">Logout</a>
                                    </span>
                                </div>
                                <div id="Settings">
                                    <span id="ctl00_lSettings">Age: 13+, Chat Mode: Safe</span>
                                </div>
                                    </div>
                                <div id="Logo">
                                    <a id="ctl00_rbxImage_Logo" title="<?=Site::getThemeProperty("name",$theme);?>" href="/" style="display:inline-block;cursor:pointer;width:267px;height:58px;">
                                        <img src="/images/<?=Site::getThemeProperty("logo",$theme);?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" blankurl="http://t2.xoblog.dev/blank-267x70.gif" style="position:relative;top:4px">
                                    </a>
                                </div>
                                <?php if ($theme == 3 && $user->getBoombux() > 0 || $theme !== 3): ?>
                                <div id="Alerts" style="position:relative;bottom:1px;">
                                    <table style="width:100%;height:100%">
                                        <tbody><tr>
                                            <td valign="middle">
                                                <div id="AlertSpace">
                                                    <?php $messages = $user->getMessageCount(); if ($messages > 0): ?>
                                                        <div id="MessageAlert">
                                                                <a class="MessageAlertIcon" href="/My/Inbox.aspx">
                                                                    <img src="/images/Message.gif" style="border-width:0px;">
                                                                </a>
                                                                <a class="MessageAlertCaption" href="/My/Inbox.aspx"><?=$messages?> new <?=$messages !== 1 ? "messages" : "message"?></a>
                                                            </div>
                                                    <?php endif; if ($user->getData("user","boombux") > 0): ?>
                                                        <div id="RobuxAlert">
                                                            <a class="RobuxAlertIcon" href="/My/AccountBalance.aspx">
                                                                <img src="/images/<?=Site::getThemeProperty("currencyIcon",$theme)?>.png" style="border-width:0px;">
                                                            </a>
                                                            <a class="RobuxAlertCaption" href="/My/AccountBalance.aspx"><?=number_format($user->getData("user","boombux"))?> <?=Site::getThemeProperty("currency",$theme)?></a>    
                                                        </div>  
                                                    <?php endif; if ($user->getData("user","tix") > 0 && $theme !== 3): ?>
                                                        <div id="TicketsAlert">
                                                            <a class="TicketsAlertIcon" href="/My/AccountBalance.aspx">
                                                                <img src="/images/Tickets.png" style="border-width:0px;">
                                                            </a>
                                                            <a class="TicketsAlertCaption" href="/My/AccountBalance.aspx"><?=number_format($user->getData("user","tix"))?> Tickets</a>
                                                        </div>
                                                    <?php endif; ?>     
                                                </div>                    			                
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </div>
                                <?php endif; ?>
                            </div>
                        <div class="Navigation">
                            <span>
                                <a class="MenuItem" href="/User.aspx">My <?=Site::getThemeProperty("alias",$theme);?></a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Games.aspx">Games</a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Catalog.aspx">Catalog</a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Browse.aspx">People</a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Upgrades/BuildersClub.aspx"><?=Site::getThemeProperty("membership",$theme);?></a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Forum/Default.aspx">Forum</a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="https://boombloxjournal.tumblr.com/" target="_blank">News</a>&nbsp;<a id="ctl00_hlNewsFeed" href="https://boombloxjournal.tumblr.com/"><img src="/images/feed-icons/feed-icon-14x14.png" alt="RSS" border="0"></a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="/Parents.aspx">Parents</a>
                            </span>
                            <span class="Separator">&nbsp;|&nbsp;</span>
                            <span>
                                <a class="MenuItem" href="https://uboomblox.miraheze.org/wiki/Main_Page" target="_blank">Help</a>
                            </span>
                            
                        </div>
                    </div>