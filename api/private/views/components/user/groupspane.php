<div id="UserGroupsPane" style="clear:both;">
	<div class="StandardBoxHeader">Groups</div>
	<div class="StandardBox" style="clear:both;">
		<?php if (count($currentUser->getGroups()) > 0): ?>
		<table id="ctl00_cphRoblox_rbxUserGroupsPane_groupThumbs" cellspacing="0" align="Center" border="0">
			<tbody>
				<tr>
					<?php foreach ($currentUser->getGroups() as $groupId): $group = new Group($groupId); ?>
					<td>
						<div id="ctl00_cphRoblox_rbxUserGroupsPane_groupThumbs_ctl00_GroupTemplateItem">
							<div class="groupEmblemThumbnail" style="width:70px; overflow:hidden;margin-left:0px;padding:0px 0px 0px 0px">
								<div class="groupEmblemImage" style="width: 70px; height:72px; margin: 0px 0px 0px 0px; padding-top: 0px; background-repeat:no-repeat; background-image:none ">
									<a id="ctl00_cphRoblox_rbxUserGroupsPane_groupThumbs_ctl00_ctl00" title="<?=htmlspecialchars($group->name())?>" href="/Groups/group.aspx?gid=<?=$groupId?>" style="display:inline-block;cursor:pointer;">
										<img src="https://t3.<?=url?>/<?=$group->emblemId()?>.png" style="height:72px" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?=htmlspecialchars($group->name())?>" blankurl="http://t4bg.roblox.com/blank-60x62.gif">
									</a>
								</div>
							</div>
						</div>
					</td>
					<?php endforeach; ?>
					<td></td>
				</tr>
			</tbody>
		</table>
		<?php endif; ?>
	</div>
</div>