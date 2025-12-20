<?php
global $user, $theme;

$name = isset($item["itemName"]) ? Helper::debugString(htmlspecialchars($item["itemName"])) : "Place";
$description = isset($item["itemDescription"]) ? htmlspecialchars($item["itemDescription"]) : NULL;
$id = $item["itemId"];
$itemId = $item["itemId"];
$creatorId = $item["creatorId"];
$creator = $item["creatorName"];
$lastUpdate = $item["lastUpdate"];
$favorites = $item["favorites"];
$interactions = $item["interactions"];
$access = $item["access"];
$copylock = (bool)$item["onsale"] == 2 ? "Shared" : "CopyLocked";

$publicView = !$user->ownsPlace($id);

$asset = new Asset($id);
$assetThumb = $asset->GetThumbnail(420, 230, "PNG");

$avatar = new Avatar($creatorId);
$avatarThumb = $avatar->GetThumbnail(500, 500, "PNG");

$player = new Avatar($creatorId);
$playerThumb = $avatar->GetThumbnail(100, 100, "JPG");
?>

<div id="Body">
	<div id="ItemContainer">
		<div id="Item">
			<h2><?=$name?></h2>
			<div id="Details">
				<div id="Thumbnail_Place">
					<a id="ctl00_cphRoblox_AssetThumbnailImage_Place" disabled="disabled" title="<?=$name?>" onclick="return false" style="display:inline-block;">
						<img src="<?=$assetThumb?>" border="0" alt="<?=$name?>">
					</a>
				</div>
                <div id="Summary">
					<h3>ROBLOX Place</h3>
					<div id="Creator" class="Creator">
						<div class="Avatar">
							<a id="ctl00_cphRoblox_AvatarImage" title="<?=$creator?>" href="/User.aspx?ID=<?=$creatorId?>" style="display:inline-block;cursor:pointer;">
								<img src="<?=$avatarThumb?>" style="height:100px;" border="0" alt="<?=$creator?>" blankurl="http://t6.roblox.com:80/blank-100x100.gif">
							</a>
						</div> Creator: <a id="ctl00_cphRoblox_CreatorHyperLink" href="User.aspx?ID=<?=$creatorId?>"><?=$creator?></a>
					</div>
					<div id="LastUpdate">Updated: <?=Helper::timeAgo($lastUpdate)?></div>
					<div id="Favorited">Favorited: <?=Helper::times($favorites)?></div>
					<div id="ctl00_cphRoblox_VisitedPanel" class="Visited">Visited: <?=Helper::times($interactions)?></div>
                    <?php if (!empty($description)): ?>
                        <div id="ctl00_cphRoblox_DescriptionPanel">
                            <div id="DescriptionLabel">Description:</div>
                            <div id="Description"><?=$description?></div>              
                        </div>
                    <?php endif; ?>
					<div id="ReportAbuse">
						<div id="ctl00_cphRoblox_AbuseReportButton1_AbuseReportPanel" class="ReportAbusePanel">
							<span class="AbuseIcon">
								<a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseIconHyperLink" href="AbuseReport/AssetVersion.aspx?ID<?=$id?>2&amp;ReturnUrl=http%3a%2f%2fxoblog.dev%2fItem.aspx%3fID%3d<?=$id?>">
									<img src="/images/abuse.PNG" alt="Report Abuse" border="0">
								</a>
							</span>
							<span class="AbuseButton">
								<a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseTextHyperLink" href="AbuseReport/AssetVersion.aspx?ID=<?=$id?>&amp;ReturnUrl=http%3a%2f%2fxoblog.dev%2fItem.aspx%3fID%3d<?=$id?>">Report Abuse</a>
							</span>
						</div>
					</div>
				</div>
				<div id="Actions_Place">
					<a <?=$user->hasFavorite($id) ? "disabled" : ""?> <?php if (!$user->hasFavorite($id)): ?> href="javascript:__doPostBack('ctl00$cphRoblox$Favorite', '')" <?php endif; ?>>Favorite</a>
				</div>
				<div id="ctl00_cphRoblox_PlayGames" class="PlayGames">
					<div style="text-align: center; margin: 1em 5px;">
						<span id="ctl00_cphRoblox_PlaceAccessIndicator_FriendsOnlyLocked" style="display: <?=!$user->friendsWith($creator) && $access == 0 && $user->getUserId() !== $creatorId ? "inline" : "none"?>">
							<img id="ctl00_cphRoblox_PlaceAccessIndicator_iFriendsOnly_Locked" src="/images/locked.png" alt="Locked" border="0">&nbsp;Friends-only </span>
						<span id="ctl00_cphRoblox_PlaceAccessIndicator_FriendsOnlyUnlocked" style="display: <?=$user->friendsWith($creator) && $access == 0 || $user->getUserId() == $creatorId && $access == 0 ? "inline" : "none"?>">
							<img id="ctl00_cphRoblox_PlaceAccessIndicator_iFriendsOnly_Unlocked" src="/images/unlocked.png" alt="Unlocked" border="0">&nbsp;Friends-only: You have access </span>
						<span id="ctl00_cphRoblox_PlaceAccessIndicator_Public" style="display:<?=$access == 1 ? "inline" : "none"?>;">
							<img id="ctl00_cphRoblox_PlaceAccessIndicator_iPublic" src="/images/public.png" alt="Public" border="0">&nbsp;Public </span>
						<img id="ctl00_cphRoblox_SharedIcon" src="/images/<?=$copylock?>.png" alt="Shared" border="0"> Copy Protection: <?=$copylock?>
					</div>
					<div id="ctl00_cphRoblox_VisitButtons_rbxPlaceLauncher_Panel1" class="modalPopup" style="display: none">
						<div style="margin: 1.5em">
							<div id="Spinner" style="float:left;margin:0 1em 1em 0">
								<img id="ctl00_cphRoblox_VisitButtons_rbxPlaceLauncher_Image1" src="/images/ProgressIndicator2.gif" alt="Progress" border="0">
							</div>
							<div id="Requesting" style="display: inline"> Requesting a server</div>
							<div id="Waiting" style="display: none"> Waiting for a server</div>
							<div id="Loading" style="display: none"> A server is loading the game</div>
							<div id="Joining" style="display: none"> The server is ready. Joining the game...</div>
							<div id="Error" style="display: none"> An error occured. Please try again later</div>
							<div id="Expired" style="display: none"> There are no game servers available at this time. Please try again later</div>
							<div id="GameEnded" style="display: none"> The game you requested has ended</div>
							<div id="GameFull" style="display: none"> The game you requested is full. Please try again later</div>
							<div style="text-align: center; margin-top: 1em">
								<input id="Cancel" type="button" class="Button" value="Cancel">
							</div>
						</div>
					</div>
					<input type="hidden" name="ctl00$cphRoblox$VisitButtons$rbxPlaceLauncher$HiddenField1" id="ctl00_cphRoblox_VisitButtons_rbxPlaceLauncher_HiddenField1">
					<?php if ($user->canAccessPlace($id)): ?>
					<div id="ctl00_cphRoblox_VisitButtons_FancyButtons">
						<div id="ctl00_cphRoblox_VisitButtons_VisitMPButton2" style="display: inline; width: 10px;">
							<?php if (Server::isIE7()): ?>
							<input type="image" name="ctl00$cphRoblox$VisitButtons$MultiplayerVisitButtonB" id="ctl00_cphRoblox_VisitButtons_MultiplayerVisitButtonB" class="ImageButton" src="/images/Play<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" alt="Visit Online" onclick='alert("You are in client, visit online is not supported yet!")'>
							<?php else: ?>
							<input type="image" name="ctl00$cphRoblox$VisitButtons$MultiplayerVisitButtonB" id="ctl00_cphRoblox_VisitButtons_MultiplayerVisitButtonB" class="ImageButton" src="/images/Play<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" alt="Visit Online" onclick='Roblox.Launch.VisitOnline("http://<?=domain?>/game/join.ashx?t=<?=time()?>", <?=$id?>, <?=Gameservers::findBestServer($id)?>); return false;'>
							<?php endif; ?>
						</div>
						<?php if (!$publicView || $item["onsale"] == 2): ?>
						<div id="ctl00_cphRoblox_VisitButtons_VisitButton2" style="display: inline; width: 10px;">
							<input type="image" name="ctl00$cphRoblox$VisitButtons$SoloVisitButtonB" id="ctl00_cphRoblox_VisitButtons_SoloVisitButtonB" class="ImageButton" src="/images/PlaySolo<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" alt="Visit Solo" onclick='Roblox.Launch.StartGame("http:\/\/<?=domain?>/Game/visit.ashx?PlaceID=<?=$id?>&t=<?=time()?>", "NA", 2, <?=$id?>); return false;'>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if (!$publicView): ?>
                    <div id="Configuration">
                        <a href="/My/Place.aspx?ID=<?=$id?>">Configure this Place</a>
                    </div>
					<div id="Advertise">
                        <a href="/My/NewUserAd.aspx?targetID=<?=$id?>">Advertise this Place</a>
                    </div>
                <?php endif; ?>
				<div style="clear: both;"></div>
			</div>
			<div style="margin:10px;width:703px;">
				<script>
					<?php if (!Server::isIE7()): ?>
					$(document).ready(function() {
						$("#cmtTab").click(function() {
							$("#ctl00_cphRoblox_TabbedInfo_GamesTab").hide();
							$("#ctl00_cphRoblox_TabbedInfo_CommentaryTab").show();
							$("#CTabAjax").addClass("ajax__tab_active");
							$("#GTabAjax").removeClass("ajax__tab_active");
						});
						$("#gmTab").click(function() {
							$("#ctl00_cphRoblox_TabbedInfo_GamesTab").show();
							$("#ctl00_cphRoblox_TabbedInfo_CommentaryTab").hide();
							$("#GTabAjax").addClass("ajax__tab_active");
							$("#CTabAjax").removeClass("ajax__tab_active");
						});
						$("#GTabAjax").hover(function() {
							$("#GTabAjax").addClass("ajax__tab_hover");
						},function() {
							$("#GTabAjax").removeClass("ajax__tab_hover");
						});
						$("#CTabAjax").hover(function() {
							$("#CTabAjax").addClass("ajax__tab_hover");
						},function() {
							$("#CTabAjax").removeClass("ajax__tab_hover");
						});
					});
					<?php else: ?>
						alert("You are in client, and some features (such as tabs & visit online) may not work properly!");
					<?php endif; ?>
				</script>
                <div class="ajax__tab_xp ajax__tab_container ajax__tab_default">
                    <div class="ajax__tab_header" style="height: 21px;">
                        <span id="GTabAjax" class="ajax__tab ajax__tab_active" style="display: inline-block;">
                            <span class="ajax__tab_outer">
                                <span class="ajax__tab_inner">
                                    <span class="ajax__tab_tab" id="__tab_ctl00_SampleContent_Tabs_Panel1"><h3 id="gmTab">Games</h3></span>
                                </span>
                            </span>
                        </span>													
                        <span id="CTabAjax" class="ajax__tab" style="display: inline-block;">
                            <span class="ajax__tab_outer">
                                <span class="ajax__tab_inner">
                                    <span class="ajax__tab_tab" id="__tab_ctl00_SampleContent_Tabs_Panel1"><h3 id="cmtTab">Commentary</h3></span>
                                </span>
                            </span>
                        </span>			
					</div>  
                    <div class="ajax__tab_body" id="ctl00_cphRoblox_TabbedInfo_CommentaryTab" style="display:none;">
                        <div class="ajax__tab_panel">
                            <?=PageBuilder::addComponent("commentary", "main", compact("id", "commentData", "commentCount"))?>
                        </div>
                    </div>
                    <div class="ajax__tab_body" id="ctl00_cphRoblox_TabbedInfo_GamesTab">
                        <div class="ajax__tab_panel" id="ctl00_cphRoblox_TabbedInfo_GamesTab_RunningGamesUpdatePanel">
                            <table id="ctl00_cphRoblox_TabbedInfo_GamesTab_RunningGamesDataList" cellspacing="0" border="0" width="100%">
                                <tbody>
                                    <?=PageBuilder::addComponent("place", "serverlist", compact("id", "playerThumb"))?>
                                </tbody>
                            </table>
                            <div class="RefreshRunningGames">
                                <input type="submit" name="ctl00$cphRoblox$TabbedInfo$GamesTab$RefreshRunningGamesButton" value="Refresh" id="ctl00_cphRoblox_TabbedInfo_GamesTab_RefreshRunningGamesButton" class="Button">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<?=Ad::generateAd("160x600")?>
		<div style="clear: both;"></div>
		<div id="ctl00_cphRoblox_ItemPurchasePopupPanel" class="modalPopup" style="display: none">
			<div id="ctl00_cphRoblox_ItemPurchasePopupUpdatePanel"></div>
		</div>
		<input type="hidden" name="ctl00$cphRoblox$HiddenField1" id="ctl00_cphRoblox_HiddenField1">
		<input type="hidden" name="ctl00$cphRoblox$HiddenField2" id="ctl00_cphRoblox_HiddenField2">
		<input type="hidden" name="ctl00$cphRoblox$HiddenField3" id="ctl00_cphRoblox_HiddenField3">
	</div>
</div>