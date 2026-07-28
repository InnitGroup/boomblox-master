<?php
global $user, $theme;
?>

<div class="MyRobloxContainer">
	<!-- Left column -->
	<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_TopFriends" class="Column1a">
		<div style="width:260px;height:28px;font-family:Verdana, Helvetica, Sans-Serif; font-size:20px; font-weight:bold; clear:both; display:block;"> Hi, <?=$user->getUsername()?> </div>
		<br clear="all" />
		<!-- Profile pic and inbox -->
		<div class="StandardBox">
			<center>
				<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_AvatarImage" disabled="disabled" title="<?=$user->getUsername()?>" onclick="return false" style="display:inline-block;height:200px;width:150px;">
                    <?php
                    $avatar = new Avatar($user->getUserId());
                    $render = $avatar->GetThumbnail(540, 660, "PNG");
                    ?>
					<img src="<?=$render?>" style="width:150px" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=$user->getUsername()?>" />
				</a>
			</center>
			<!-- Top banner alerts moved down here -->
			<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_AlertSpacePanel">
				<div id="AlertSpace">
                    <?php $messages = $user->getMessageCount(); if ($messages > 0): ?>
					<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_MessageAlertPanel">
						<div id="MessageAlert">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_MessageAlertIconHyperLink" class="MessageAlertIcon" href="/My/Inbox.aspx">
								<img src="/images/Message.gif" style="border-width:0px;" />
							</a>&nbsp; <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_MessageAlertCaptionHyperLink" class="MessageAlertCaption" href="/My/Inbox.aspx"><?=number_format($messages)?> new <?=$messages !== 1 ? "messages" : "message"?></a>
						</div>
					</div>
                    <?php endif; ?>
                    <?php if ($user->getBoombux() > 0): ?>
					<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_RobuxAlertPanel">
						<div id="RobuxAlert">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_RobuxAlertIconHyperLink" class="RobuxAlertIcon" href="/My/AccountBalance.aspx">
								<img src="/images/<?=Site::getThemeProperty("currencyIcon", $theme)?>.png" style="border-width:0px;" />
							</a>&nbsp; <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_RobuxAlertCaptionHyperLink" class="RobuxAlertCaption" href="/My/AccountBalance.aspx"><?=number_format($user->getBoombux())?> <?=Site::getThemeProperty("currency", $theme)?></a>
						</div>
					</div>
                    <?php endif; ?>
                    <?php if ($user->getTickets() > 0): ?>
					<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_TicketsAlertPanel">
						<div id="TicketsAlert">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_TicketsAlertIconHyperLink" class="TicketsAlertIcon" href="/My/AccountBalance.aspx">
								<img src="/images/Tickets.png" style="border-width:0px;" />
							</a>&nbsp; <a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rbxAlerts_TicketsAlertCaptionHyperLink" class="TicketsAlertCaption" href="/My/AccountBalance.aspx"><?=number_format($user->getTickets())?> Tickets</a>
						</div>
					</div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
		<br clear="all" />
		<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_pnlBestFriends">
			<div class="StandardBoxHeader"> My Best Friends ( <a style="color:#ccccff" href="/my/EditFriends.aspx">Edit</a>) </div>
			<div class="StandardBox" style="height:1020px;text-align:center">
				<table width="260px">
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl01_hlAvatar" title="builderman" href="/User.aspx?ID=156" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t5bg.roblox.com/e99458ec546d8987d7d2e1226e8e3393" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="builderman" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=156"> builderman </a>&nbsp; [Offline] <br />
							<i>"I'm online sometimes but only for a few minutes to add all my new friends! You can send me questions about help topics!" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl02_hlAvatar" title="Shedows" href="/User.aspx?ID=2728334" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/2b8150fc78127d8e7563cd2c45ef6b90" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Shedows" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=2728334"> Shedows </a>&nbsp; [Offline] <br />
							<i>"havin fun and just "chillen"" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl03_hlAvatar" title="deltaecho1" href="/User.aspx?ID=4427838" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t5bg.roblox.com/77935f0712ac2c1718f99d4556c89320" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="deltaecho1" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=4427838"> deltaecho1 </a>&nbsp; [Offline] <br />
							<i>"Playing" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl04_hlAvatar" title="ttfootball" href="/User.aspx?ID=1132938" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/99e8935f1631a03f7ce54961402ba8ba" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="ttfootball" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=1132938"> ttfootball </a>&nbsp; [Offline] <br />
							<i>"recreating games yah i know tried faild but this time i WONT HAHAH haha ha." <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl05_hlAvatar" title="KINGOFBLOXERSBRAWL" href="/User.aspx?ID=4426820" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/6e8db55b2836c6b636ad88e4b49ed6b7" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="KINGOFBLOXERSBRAWL" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=4426820"> KINGOFBLOXERSBRAWL </a>&nbsp; [Offline] <br />
							<i>"pwning noobs" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl06_hlAvatar" title="jonah250" href="/User.aspx?ID=1873323" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t0bg.roblox.com/17d8d2485295b3a81a99a1dcaf6844c1" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="jonah250" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=1873323"> jonah250 </a>&nbsp; [Offline] <br />
							<i>"wow my computer has viruses NOOOOOO!!!!! thats last playing that flash game do not play something something mech flash game it give viruses" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl07_hlAvatar" title="Person299" href="/User.aspx?ID=214258" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t1bg.roblox.com/4e094a229f6e58fb4ebde7fc67d2e0f2" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Person299" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=214258"> Person299 </a>&nbsp; [Offline] <br />
							<i>"You know, weird brown bugs invading peoples' computer screens is a serious problem." <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl08_hlAvatar" title="Hardy6208" href="/User.aspx?ID=3125195" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/1f9aef21043bd27dc0d107a036b6f3ce" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Hardy6208" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=3125195"> Hardy6208 </a>&nbsp; [Offline] <br />
							<i>"Hey ppl this is the real hardy and i am jeffhardyrocks901's best friend in real life and you can ask him but please do not hack me,me and jeffhardyrocks901 are tight." <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl09_hlAvatar" title="UltraInfernape" href="/User.aspx?ID=4619088" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t3bg.roblox.com/b7d33cdfdbcd7bb45fbeb2605ac6e918" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="UltraInfernape" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=4619088"> UltraInfernape </a>&nbsp; [Offline] <br />
							<i>"idk bored." <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl10_hlAvatar" title="benhardur1" href="/User.aspx?ID=3212595" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t4bg.roblox.com/47f54ef4c8d37cfcf460762a0d3b0b95" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="benhardur1" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=3212595"> benhardur1 </a>&nbsp; [Offline] <br />
							<i>"i'am inn army whit TaaRt" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl11_hlAvatar" title="tigersub" href="/User.aspx?ID=1083640" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/85fe7c000aac815b249a7077bfcc298d" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="tigersub" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=1083640"> tigersub </a>&nbsp; [Offline] <br />
							<i></i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl12_hlAvatar" title="Vendettathegreat" href="/User.aspx?ID=469797" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t2bg.roblox.com/b8867af4c2114c02fa23c2bcc3788fd2" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Vendettathegreat" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=469797"> Vendettathegreat </a>&nbsp; [Online] <br />
							<i>"I had my account XxMario100xX stolen from me by Beandaman, then sold to 1BALL10." <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl13_hlAvatar" title="DEMONFOXD" href="/User.aspx?ID=4650401" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t0bg.roblox.com/c767a67525a68a98969942352de4db89" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="DEMONFOXD" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=4650401"> DEMONFOXD </a>&nbsp; [Offline] <br />
							<i></i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl14_hlAvatar" title="orniocho2" href="/User.aspx?ID=2841705" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t3bg.roblox.com/17fbb3f03da7a9c6988e48f7b3ab86a9" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="orniocho2" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=2841705"> orniocho2 </a>&nbsp; [Offline] <br />
							<i>"on the pc being fat and eating kfc" <br />
							</i>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl15_hlAvatar" title="Skarm65" href="/User.aspx?ID=4410884" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="http://t7bg.roblox.com/4c2109be93720c24879ae7354c9dbea7" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Skarm65" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=4410884"> Skarm65 </a>&nbsp; [Offline] <br />
							<i>"bored" <br />
							</i>
						</td>
					</tr>
				</table>
			</div>
			<br clear="all" />
		</div>
		<!-- Connect to facebook -->
		<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_facebookPanel_pnlNotLoggedIn">
			<div class="StandardBoxHeader" style="padding-bottom:1px; padding-top:1px"> Facebook Connect&nbsp;&nbsp; <a onclick="$('#fbHelp').show(); return false;" href="#">
					<img border="0" alt="How does this work?" src="/images/buttons/questionmark-25x25.png" style="width:20px; height:20px;" align="middle" />
				</a>
			</div>
			<div class="StandardBox">
				<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
				<div style="text-align:left; margin-bottom:5px"> Link your Roblox account with your Facebook to let your Facebook friends see what you're doing on Roblox! <br />
				</div>
				<fb:login-button onlogin="FB.Connect.showPermissionDialog('offline_access, publish_stream', function(result){location.reload();});"></fb:login-button>
				<script type="text/javascript">
					FB.init("ad0130f1a00d8b9714e6e735bd414232", "xd_receiver.htm", {
						"reloadIfSessionStateChanged": false
					});
				</script>
				<div style="font-weight:bold; color:#990000;">
					<br />PLEASE NOTE: Your Facebook profile information (name, picture, etc.) will NOT be shared with other Roblox users.
				</div>
			</div>
		</div>
		<div id="fbHelp" style="display:none; position:relative; top:-300px; left:400px; width:250px; height:180px; background-color:#ffffff; border: solid 2px blue; padding:10px 10px 10px 10px; text-align:center"> Facebook Connect allows you to show off your Roblox <i>status</i>, <i>character</i>, and <i>places</i> to your friends on Facebook. <br />
			<br /> Roblox does <b>not</b> collect or store your Facebook username or password, and no one on Roblox can see any of your Facebook profile information. <br />
			<br />
			<b style="color:#cc0000">Use of Facebook Connect is strictly voluntary and is not required to use Roblox.</b>
			<div align="right">
				<b>
					<a href="#" onclick="$('#fbHelp').hide();return false;">Close</a>
				</b>
			</div>
		</div>
	</div>
	<!-- Right column -->
	<div class="Column2a" style="overflow:hidden;">
		<!-- Update my status; use one-way AJAX pattern -->
		<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_statusUpdateBox" class="StandardBox">
			<b style="font-size:16px;"> Right now I'm: </b>
			<br />
			<INPUT type="text" style="VISIBILITY: hidden;POSITION: absolute">
			<!-- Enter key submission hack - IE -->
			<input name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$txtStatusMessage" type="text" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_txtStatusMessage" style="margin-bottom:5px;width:540px;" maxlength="254" value="Starting A clan to  Bring Fleskhjerta back!" />
			<br />
			<input type="submit" name="ctl00$ctl00$cphRoblox$cphMyRobloxContent$btnUpdateStatus" value="Update Status" id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_btnUpdateStatus" />&nbsp;&nbsp; <br />
			<br />
		</div>
		<br clear="all" />
		<div class="StandardBoxHeader"> My Feed </div>
		<div class="StandardBox" id="FeedDisplayRegion" style="font-size: 12px;">
			<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_theFeed_pnlFeed">
				<span id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_theFeed_Loader" style="visibility:hidden;display:none;"></span>
				<div id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_theFeed_pnlLoading">
					<center> Please wait. Roblox is getting your Feed :)</center>
				</div>
			</div>
		</div>
	</div>
	<br clear="all" />
</div>