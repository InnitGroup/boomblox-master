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
		<link rel="stylesheet" href="/CSS/AllCSS.ashx?v=6">
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
										<span id="ctl00_BannerOptionsLoginView_BannerOptions_Authenticated_lnLoginName">Logged in as <?=$user->getUsername()?> | </span>
										<a id="ctl00_BannerOptionsLoginView_BannerOptions_Authenticated_lsLoginStatus" href="javascript:__doPostBack('ctl00$BannerOptionsLoginView$BannerOptions_Authenticated$lsLoginStatus$ctl00','')">Logout</a>
									</span>
								</div>
							</div>
							<a id="Logo" href="/Default.aspx" style="cursor: pointer; border: none;">
								<img src="/images/<?=Site::getThemeProperty("logo", $theme)?>?t=<?=time()?>" border="0" alt="<?=Site::getThemeProperty("name",$theme);?>" blankurl="http://t2.<?=domain?>/blank-267x70.gif" style="">
							</a>
							<div id="Alerts">
								<table style="width:100%;height:100%">
									<tr>
										<td valign="middle">
											<div id="ctl00_BannerAlertsLoginView_BannerAlerts_Authenticated_rbxBannerAlert_rbxAlerts_AlertSpacePanel">
												<div class="AlertSpace">
													<div class="MessageAlert">
														<div class="icons message_icon"></div>
														<a id="ctl00_BannerAlertsLoginView_BannerAlerts_Authenticated_rbxBannerAlert_rbxAlerts_MessageAlertCaptionHyperLink" class="MessageAlertCaption" href="../My/Inbox.aspx"><?=number_format($user->getMessageCount())?> new messages</a>
													</div>
													<div class="FriendsAlert">
														<div class="icons friends_icon"></div>
														<a id="ctl00_BannerAlertsLoginView_BannerAlerts_Authenticated_rbxBannerAlert_rbxAlerts_FriendsAlertCaptionHyperLink" class="FriendsAlertCaption" href="../User.aspx?submenu=true#friendreqs">0 friend requests</a>
													</div>
													<div class="RobuxAlert">
														<div class="icons robux_icon"></div>
														<a id="ctl00_BannerAlertsLoginView_BannerAlerts_Authenticated_rbxBannerAlert_rbxAlerts_RobuxAlertCaptionHyperLink" class="RobuxAlertCaption" href="../My/AccountBalance.aspx"><?=number_format($user->getBoombux())?> ROBUX</a>
													</div>
													<div class="TicketsAlert">
														<div class="icons tickets_icon"></div>
														<a id="ctl00_BannerAlertsLoginView_BannerAlerts_Authenticated_rbxBannerAlert_rbxAlerts_TicketsAlertCaptionHyperLink" class="TicketsAlertCaption" href="../My/AccountBalance.aspx"><?=number_format($user->getTickets())?> Tickets</a>
													</div>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="Navigation">
							<ul id="ctl00_Menu_MenuUL">
								<li>
									<a id="ctl00_Menu_hlMyRobloxLink_hlMyRoblox" href="../My/Home.aspx" style="">My ROBLOX</a>
								</li>
								<li>
									<a id="hlGames" href="/Games.aspx" style="" title="Games">Games</a>
									<!--
								<ul><li><div class="dropdownmainnav"><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Classic.png" /><a href='/all-games'
															title="All" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															All</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/City.png" /><a href='/town-and-city-games'
															title="Town and City" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Town and City</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Castle.png" /><a href='/medieval-games'
															title="Medieval" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Medieval</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/SciFi.png" /><a href='/sci-fi-games'
															title="Sci-Fi" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Sci-Fi</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Ninja.png" /><a href='/ninja-games'
															title="Ninja" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Ninja</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Cthulu.png" /><a href='/scary-games'
															title="Horror" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Horror</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Pirate.png" /><a href='/pirate-games'
															title="Pirate" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Pirate</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Adventure.png" /><a href='/adventure-games'
															title="Adventure" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Adventure</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Sports.png" /><a href='/sports-games'
															title="Sports" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Sports</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/LOL.png" /><a href='/funny-games'
															title="LOL" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															LOL</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/WildWest.png" /><a href='/wild-west-cowboy-games'
															title="Wild West" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Wild West</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/ModernMilitary.png" /><a href='/war-games'
															title="Modern Military" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Modern Military</a></div><div style="float: left; width: 50%; text-align: left;"><img src="/images/GenreIconsInverted/Skatepark.png" /><a href='/skatepark-games'
															title="Skate Park" style="padding: 0; margin: 0 2px 0 0; border: none; font-size: 15px;">
															Skate Park</a></div></div></li></ul>
								!-->
								</li>
								<li>
									<a id="hlCatalog" href="/Catalog.aspx" style="" title="Catalog">Catalog</a>
								</li>
								<li>
									<a id="hlBrowse" href="/Browse.aspx" style="" title="People">People</a>
								</li>
								<li>
									<a id="hlBuildersClub" href="/Upgrades/BuildersClub.aspx" style="" title="Builders Club">Builders Club</a>
								</li>
								<li id="ctl00_Menu_ContestsMenuTab">
									<a id="hlContests" href="/Contests/" style="" title="Contests">Contests</a>
								</li>
								<li>
									<a id="hlForum" onclick="" href="/Forum/Default.aspx" style="font-weight: bold; " title="Forum">Forum</a>
								</li>
								<li>
									<a id="hlNews" href="http://blog.roblox.com/" target="_blank" title="News">News</a>
									<a id="hlNewsFeed" href="http://blog.roblox.com/?feed=rss" title="RSS" class="icons rss_icon" style="padding: 0; margin: 0 2px 0 0; border: none;"></a>
								</li>
								<li>
									<a id="hlParents" href="/Parents.aspx" style="" title="Parents">Parents</a>
								</li>
								<li>
									<a id="hlHelp" href="/Help/Builderman.aspx" style="" title="Help">Help</a>
								</li>
							</ul>
						</div>
					</div>
					<div id="ctl00_Announcement">
						<div class="SystemAlert">
							<div id="ctl00_SystemAlertTextColor" class="SystemAlertText" style="background-color:orange;">
								<div class="Exclamation"></div>
								<div id="ctl00_LabelAnnouncement">Are you an experienced Robloxian? Come try out the game on gametest.roblox.com</div>
							</div>
						</div>