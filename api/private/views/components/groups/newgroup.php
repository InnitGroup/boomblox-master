<?php
global $user;
$userId = $user->getUserId();
$group = new Group($_GET["gid"]);

if (Server::isPost()) {
    if (isset($_POST['ctl00$cphRoblox$JoinGroup'])) {
        $group->addMember($user->getUserId());
    } elseif (isset($_POST['ctl00$cphRoblox$LeaveGroup'])) {
        $group->kickMember($user->getUserId());
    }
}
?>

<div id="Body">
	<div class="MyRobloxContainer">
		<div style="width: 876px; height: 28px; clear: both; display: block; background-color: #006699;" class="StandardBox" id="SearchControls">
			<table width="876px" border="0">
				<tbody>
					<tr>
						<td style="font-family: Verdana, Helvetica, Sans-Serif; font-size: 12pt; color: White;
                font-weight: bold; width: 200px; text-align: left;"> Search Groups: </td>
						<td style="width: 660px; text-align: right;">
							<input name="ctl00$cphRoblox$GroupSearchBar$SearchKeyword" type="text" id="ctl00_cphRoblox_GroupSearchBar_SearchKeyword" onclick="javascript:if($get(SearchKeywordText).value =='Search all groups') $get(SearchKeywordText).value = '';" style="width: 520px;" maxlength="100" value="Search all groups">
							<!--<select name="ctl00$cphRoblox$GroupSearchBar$SearchFiltersDropdown2" id="ctl00_cphRoblox_GroupSearchBar_SearchFiltersDropdown2"></select>-->
							<input type="submit" name="ctl00$cphRoblox$GroupSearchBar$SearchButton" value="Search" onclick="javascript:if ($get(SearchKeywordText).value == '' || $get(SearchKeywordText).value == 'Search all groups') return false;" id="ctl00_cphRoblox_GroupSearchBar_SearchButton">
							<input type="text" style="visibility: hidden; position: absolute">
							<!-- Enter key submission hack - IE -->
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
			var SearchKeywordText = 'ctl00_cphRoblox_GroupSearchBar_SearchKeyword';
		</script>
		<div class="Column1b">
            <?php if ($group->isInGroup($userId)): ?>
            <div style="overflow:visible; padding: 10px 5px 10px 5px; width: 176px; float: left" class="StandardBox">
                <div style="text-align:center;font-size: 18px;"><u>My Rank</u></div>
                <div style="text-align:center;font-size: 24px;color:<?=$group->getRoleset($userId)["Name"] == "Owner" ? "brown" : "#00FF00"?>;"><?=$group->getRoleset($userId)["Name"]?></div>
                <div id="ctl00_cphRoblox_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
                    <span class="AbuseIcon">
                        <a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseIconHyperLink" href="/AbuseReport/Group.aspx?ID=10&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">
                            <img src="/images/abuse.PNG?v=2" alt="Report Abuse" border="0">
                        </a>
                    </span>
                    <span class="AbuseButton">
                        <a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseTextHyperLink" href="/AbuseReport/Group.aspx?ID=10&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">Report Abuse</a>
                    </span>
                </div>
            </div>
            <?php endif; ?>

			<div id="ad" class="StandardBox" style="height: 600px">
				<div style="overflow: hidden;">
					<div id="ctl00_cphRoblox_ForumsSkyscraper_OutsideAdPanel" class="AdPanel">
						<iframe id="ctl00_cphRoblox_ForumsSkyscraper_AsyncAdIFrame" allowtransparency="true" frameborder="0" scrolling="no" height="600" src="/IFrameAdContent.aspx?v=2&amp;slot=Roblox_Default_Right_160x600&amp;format=skyscraper&amp;v=2" width="160" data-ruffle-polyfilled=""></iframe>
					</div>
					<a id="ctl00_cphRoblox_ForumsSkyscraper_ReportAdButton" title="click to report an offensive ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cphRoblox$ForumsSkyscraper$ReportAdButton','')">[ report ]</a>
				</div>
			</div>
		</div>
		<div class="Column2b">
			<div id="description">
				<div class="StandardBoxHeader"> <?=htmlspecialchars(Helper::debugString($group->name()))?> </div>
				<div class="StandardBox">
					<div class="GroupDescriptionThumbnail">
						<a id="ctl00_cphRoblox_GroupDescriptionEmblem" title="<?=htmlspecialchars(Helper::debugString($group->name()))?>" onclick="__doPostBack('ctl00$cphRoblox$GroupDescriptionEmblem','')" style="display:inline-block;cursor:pointer;">
							<img src="https://t3.xoblog.dev/<?=$group->emblemId()?>.png" style="height:150px" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=htmlspecialchars(Helper::debugString($group->name()))?>" blankurl="http://t6bg.roblox.com/blank-150x150.gif">
						</a>
					</div>
					<div style="height: 100%">
						<p style="color: #A9A9A9;">Owned By: <a style="color: Purple; font-style: italic;" href="/user.aspx?id=<?=$group->creator()->getUserId()?>"><?=$group->creator()->getUsername()?></a>
						</p>
						<p><?=htmlspecialchars(Helper::debugString($group->description()))?></p>
						<div id="ctl00_cphRoblox_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
							<span class="AbuseIcon">
								<a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseIconHyperLink" href="/AbuseReport/Group.aspx?ID=10&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">
									<img src="/images/abuse.PNG?v=2" alt="Report Abuse" border="0">
								</a>
							</span>
							<span class="AbuseButton">
								<a id="ctl00_cphRoblox_AbuseReportButton_ReportAbuseTextHyperLink" href="/AbuseReport/Group.aspx?ID=10&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">Report Abuse</a>
							</span>
						</div>
					</div>
					<br style="clear: both; height: 1px">
				</div>
			</div>
			<br style="clear:both;">
			<div id="ctl00_cphRoblox_GroupWallPane_Wall">
				<div class="StandardBoxHeader">Wall</div>
				<div class="StandardBox">
					<table class="Repeater" cellpadding="0" cellspacing="0">
						<tbody>
							<tr class="AlternatingItemTemplateOdd">
								<td class="RepeaterImage" style="width: 50px">
									<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl01_hlAvatar" title="marsoc" href="/User.aspx?ID=3" style="display:inline-block;cursor:pointer;">
										<img src="https://t2.xoblog.dev/2d72f10b5266a0ee1c4e4863d141036c?v=1" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="marsoc">
									</a>
								</td>
								<td class="RepeaterText">
									<div style="overflow:hidden; width: 456px">
										<a href="/User.aspx?ID=3"> marsoc </a> says: <b>
											<i>hi test</i>
										</b>
										<br>
										<br>
									</div>
									<div>
										<div style="float: left; width: 30%">
											<span style="color: Gray; font-size: 8px">7/23/2010 2:08:48 AM</span>
										</div>
										<div style="float: left">
											<div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl01_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
												<span class="AbuseIcon">
													<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl01_AbuseReportButton_ReportAbuseIconHyperLink" href="/AbuseReport/GroupWallPost.aspx?ID=8729834&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">
														<img src="/images/abuse.PNG?v=2" alt="Report Abuse" border="0">
													</a>
												</span>
												<span class="AbuseButton">
													<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl01_AbuseReportButton_ReportAbuseTextHyperLink" href="/AbuseReport/GroupWallPost.aspx?ID=8729834&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">Report Abuse</a>
												</span>
											</div>
											<br>
										</div>
									</div>
									<br style="clear: both">
									<div></div>
								</td>
							</tr>
							<tr class="AlternatingItemTemplateEven">
								<td class="RepeaterImage" style="width: 50px">
									<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl02_hlAvatar" title="marsoc" href="/User.aspx?ID=3" style="display:inline-block;cursor:pointer;">
										<img src="https://t2.xoblog.dev/2d72f10b5266a0ee1c4e4863d141036c?v=1" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="marsoc">
									</a>
								</td>
								<td class="RepeaterText">
									<div style="overflow:hidden; width: 456px">
										<a href="/User.aspx?ID=3"> marsoc </a> says: <b>
											<i>first post haha</i>
										</b>
										<br>
										<br>
									</div>
									<div>
										<div style="float: left; width: 30%">
											<span style="color: Gray; font-size: 8px">7/22/2010 7:36:39 PM</span>
										</div>
										<div style="float: left">
											<div id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl02_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
												<span class="AbuseIcon">
													<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl02_AbuseReportButton_ReportAbuseIconHyperLink" href="/AbuseReport/GroupWallPost.aspx?ID=8720094&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">
														<img src="/images/abuse.PNG?v=2" alt="Report Abuse" border="0">
													</a>
												</span>
												<span class="AbuseButton">
													<a id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl02_AbuseReportButton_ReportAbuseTextHyperLink" href="/AbuseReport/GroupWallPost.aspx?ID=8720094&amp;RedirectUrl=http%3a%2f%2fwww.roblox.com%2fGroups%2fgroup.aspx%3fgid%3d10">Report Abuse</a>
												</span>
											</div>
											<br>
										</div>
									</div>
									<br style="clear: both">
									<div></div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<td id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl11_FooterPagerPanel" class="FooterPager" style="text-align: center" colspan="2">
									<span id="ctl00_cphRoblox_GroupWallPane_GroupWall_ctl11_FooterPagerLabel">Page 1 of 1</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="Column3b">
            <div style="overflow:visible; padding: 10px 5px 10px 5px; width: 176px; float: left" class="StandardBox">
                <div style="text-align:center">
                    <img src="/images/groups.png">
                    <a href="/My/CreateGroup.aspx" style="font-size:12px">Create a group</a>
                </div>
            </div>
			<div id="GroupRoleSetsMembersPane">
				<div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_GroupMembersUpdatePanel">
					<div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_RolesetHeader" class="StandardBoxHeader" style="float: left; text-align: center; font-size: 14px; vertical-align: middle">Members (<?=count($group->members())?>) <br>
						<?php if ($group->isInGroup($userId)): ?>
                        <span style="font-size: 12px; color: black">Rank: <b><?=$group->getRank($userId)?></b>
                        <?php endif; ?>
						</span>
					</div>
					<div style="overflow:visible; padding: 10px 5px 10px 5px; width: 176px; float: left" class="StandardBox">
						<div style="float: left; width: 176px;">
                            
                            <?php $count = 0; foreach ($group->members() as $key => $member): 
                            $memberUser = new User($key);
                            $avatar = new Avatar($key);
                            $status = $memberUser->isOnline() ? "Online" : "Offline";
                            $location = $memberUser->isOnline() ? "online at " . $memberUser->getStatus() : "offline (last seen at " . $memberUser->lastOnline() . ")";
                            if (($count) % 3 == 0): ?>
							<div style="height: 70px; margin-bottom: 5px">
                            <?php endif; ?>
								<div class="GroupMember" style="float: right; text-align: center; width:  33%">
									<div class="Avatar">
										<a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_ctl01_hlAvatar" title="<?=$memberUser->getUsername()?>" href="/User.aspx?ID=<?=$memberUser->getUserId()?>" style="display:inline-block;cursor:pointer;">
											<img src="<?=$avatar->GetThumbnail(48,48,"JPG")?>" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=$memberUser->getUsername()?>">
										</a>
									</div>
									<div class="Summary">
										<span class="OnlineStatus">
											<img id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_ctl01_iOnlineStatus" src="/images/<?=$status?>.png" alt="<?=$memberUser->getUsername()?> is <?=$location?>)." border="0">
										</span>
										<span class="Name">
											<a id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_ctrl0_ctl01_hlMember" title="<?=$memberUser->getUsername()?>" href="/User.aspx?ID=<?=$memberUser->getUserId()?>"><?=mb_strimwidth($memberUser->getUsername(), 0, 7, "...")?></a>
										</span>
									</div>
								</div>
                            <?php if (($count+1) % 3 == 0): ?>
							</div>
                            <?php endif; $count += 1; endforeach; ?>
							<div id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer_div" class="FooterPager" style="clear: both; text-align: center; margin-bottom: 5px">
								<hr>
								<span id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlUsers_Footer">
									<a disabled="disabled">First</a>&nbsp; <a disabled>Last</a>&nbsp; <br>
									<a disabled="disabled">Previous</a>&nbsp; <span>1</span>&nbsp; <a disabled>Next</a>&nbsp; </span>
							</div>
						</div>
						<div style="float: left; width: 176px;">
							<style type="text/css">
								.RoleSetButton {
									border: 2px solid #243A4A;
									padding: 2px;
									margin-bottom: 2px;
									cursor: pointer;
									background-color: Gray;
									position: relative;
									z-index: 10;
								}

								.SelectedRoleSetButton {
									border: 2px solid #243A4A;
									background-color: White;
									padding: 2px;
									margin-bottom: 2px;
									cursor: pointer;
									position: relative;
									z-index: 10;
								}
							</style>
							<input type="submit" name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlRolesetList$ctl00$Button1" value="Member" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlRolesetList_ctl00_Button1" title="Member" class="SelectedRoleSetButton" style="width: 176px; font-size: 12px">
							<input type="submit" name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlRolesetList$ctl01$Button1" value="Admin" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlRolesetList_ctl01_Button1" title="Admin" class="RoleSetButton" style="width: 176px; font-size: 12px">
							<input type="submit" name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$dlRolesetList$ctl02$Button1" value="Owner" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_dlRolesetList_ctl02_Button1" title="Owner" class="RoleSetButton" style="width: 176px; font-size: 12px">
						</div>
					</div>
					<input name="ctl00$cphRoblox$rbxGroupRoleSetMembersPane$currentRoleSetID" type="hidden" id="ctl00_cphRoblox_rbxGroupRoleSetMembersPane_currentRoleSetID" value="165">
				</div>
				<br style="clear: both">
			</div>
			<div>
                <?php if ($group->isInGroup($userId)): ?>
				<input type="submit" name="ctl00$cphRoblox$LeaveGroup" value="Leave Group" id="ctl00_cphRoblox_LeaveGroup">
                <?php elseif (!$group->isInGroup($userId)): ?>
                <input type="submit" name="ctl00$cphRoblox$JoinGroup" value="Join Group" id="ctl00_cphRoblox_JoinGroup">
                <?php endif; ?>
			</div>
			<div></div>
			<div></div>
		</div>
	</div>
	<br style="clear: both">
</div>