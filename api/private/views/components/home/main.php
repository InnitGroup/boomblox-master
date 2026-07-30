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
			<div class="StandardBox" style="text-align:center">
				<?php $bestFriends = $user->getBestFriends(); if (!empty($bestFriends) && $bestFriends !== NULL): ?>
				<table width="260px">
					<?php foreach ($bestFriends as $bestFriend): $friendUser = new User($bestFriend); $friendAvatar = new Avatar($bestFriend); ?>
					<tr>
						<td valign="top" align="left" width="60px" height="60px">
							<a id="ctl00_ctl00_cphRoblox_cphMyRobloxContent_rptBFF_ctl01_hlAvatar" title="<?=$friendUser->getUsername()?>" href="/User.aspx?ID=<?=$bestFriend?>" style="display:inline-block;height:48px;width:48px;cursor:pointer;">
								<img src="<?=$friendAvatar->GetThumbnail(48, 48, "JPG")?>" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=$friendUser->getUsername()?>" />
							</a>
							<br />
						</td>
						<td valign="top" align="left" width="200px">
							<a href="/User.aspx?ID=<?=$bestFriend?>"> <?=$friendUser->getUsername()?> </a>&nbsp; [<?=$friendUser->isOnline() ? "Online" : "Offline"?>] <br />
							<i>"<?=htmlspecialchars(Helper::debugString($friendUser->getBlurb()))?>" <br />
							</i>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php else: ?>
				<div>
				<?php endif; ?>
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