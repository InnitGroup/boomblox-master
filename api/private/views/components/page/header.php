<?php
global $theme, $auth, $user;
if (Server::isPost()) {
	if ($_POST["__EVENTTARGET"] == "LoginStatus") {
		exit(header("Location: /api/quicklogout.ashx"));
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title> <?=$title?> </title>
		<link rel="icon" href="/images/
			<?=Site::getThemeProperty("favicon", $theme)?>?v=
			<?=time()?>">
		<link rel="stylesheet" href="/CSS/AllCSS.ashx?v=<?=$theme == 1 ? "6" : "8"?>">
		<link rel="stylesheet" href="/CSS/Ajax.css?t=
					<?=time()?>">
		<meta name="robots" content="noindex"> <?php if (isset($hasAds)): ?> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4924425901885448" crossorigin="anonymous"></script> <?php endif; ?> <?php if (Server::isIE7()): ?> <script src="/ScriptResource.axd?v=
							<?=time()?>">
		</script>
		<script src="https://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js"></script> <?php else: ?> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script src="/ScriptResource.axd?v=
							<?=time()?>">
		</script> <?php endif; ?> <?php if (isset($jsList)): foreach ($jsList as $js): ?> <script src="/ScriptResource.axd?d=
							<?=base64_encode($js)?>">
		</script> <?php endforeach; endif; ?>
        <style>
            .subMenu
            {
                background:url('/images/UI/subMenuBackground.jpg?v=2');
                background-repeat:repeat-x;
                color:White;
                font-family:Arial, Helvetica, Sans-Serif; 
                font-size:14px;
                height:20px; 
                position:relative; 
                border-left: solid 1px black; 
                border-right: solid 1px black; 
                border-bottom:solid 1px black;
                padding-left:5px;
                padding-top:5px;
                margin-bottom:10px;
                z-index:999;
            }
            a.subMenuItem
            {
                font-family:Arial, Helvetica, Sans-Serif; 
                font-size:14px; 
                color:White;
            }
            a.subMenuItem:link
            {
                font-family:Arial, Helvetica, Sans-Serif; 
                font-size:14px; 
                color:White;
            }
            a.subMenuItem:visited
            {
                font-family:Arial, Helvetica, Sans-Serif; 
                font-size:14px; 
                color:White;
            }
            .subMenuItem.selected
            {
                font-weight:bold;
                text-decoration:underline;
            }
        </style>
	</head>
	<body>
		<form name="aspnetForm" method="post" id="aspnetForm" <?=isset($enc) ? "enctype='".$enc."'" : ""?>>
			<input type="hidden" name="__EVENTARGUMENT">
			<input type="hidden" name="__EVENTTARGET">
			<input type="hidden" name="__VIEWSTATE" value="
										<?=Viewstate::generateViewState()?>">
			<div id="MasterContainer">
				<div id="Container"> <?=Ad::generateAd("728x90")?> 
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
                                    <a id="ctl00_rbxImage_Logo" title="<?=Site::getThemeProperty("name",$theme);?>" href="/" style="display:inline-block;cursor:pointer;position:relative;top:4px">
                                        <img src="/images/<?=Site::getThemeProperty("logo", $theme)?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" blankurl="http://t2.<?=domain?>/blank-267x70.gif" style="">
                                    </a>
                                </div>
                                <?php if ($theme == 3 && $user->getBoombux() > 0 || $theme !== 3): ?>
                                <div id="Alerts">
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
                        <?php if (Setting::enabled("SystemAlert")): ?>
                        <div style="text-align:center;background-color:#E7BACF;color:black;font-size:14px;position:relative;font-family:'Comic Sans MS', 'Comic Sans', cursive;"><?=htmlspecialchars(Helper::debugString(Site::currentShout()))?></div>
                        <?php endif; ?>
                    </div>
					<div id="Body">
                        <div id="ctl00_ctl00_cphRoblox_subMenu" class="subMenu">
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/Home.aspx" ? "selected" : ""?>" href="/My/Home.aspx">Home</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/Profile.aspx" ? "selected" : ""?>" href="/My/Profile.aspx">Account</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/User.aspx" ? "selected" : ""?>" href="/User.aspx">Profile</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/EditFriends.aspx" ? "selected" : ""?>" href="/My/EditFriends.aspx">Friends</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/Character.aspx" ? "selected" : ""?>" href="/My/Character.aspx">Character</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/Groups/Search.aspx" ? "selected" : ""?>" href="/Groups/Search.aspx">Groups</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/AccountBalance.aspx" ? "selected" : ""?>" href="/My/AccountBalance.aspx">Money</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/AdInventory.aspx" ? "selected" : ""?>" href="/My/AdInventory.aspx">Advertising</a> |
                            <a class="subMenuItem <?=$_SERVER["REQUEST_URI"] == "/My/InviteAFriend.aspx" ? "selected" : ""?>" href="/My/InviteAFriend.aspx">Ambassadors</a>
                        </div>