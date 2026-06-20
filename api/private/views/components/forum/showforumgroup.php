<?php
global $group, $user;

PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
PageBuilder::addComponent("forum", "whereami");
?>

<p></p>
<table cellpadding="2" cellspacing="1" border="0" width="100%" class="tableBorder">
	<tbody>
		<tr>
			<th class="tableHeaderText" colspan="2" height="20">Forum</th>
			<th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th>
			<th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th>
			<th class="tableHeaderText" width="135" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
		</tr>
		<tr id="ctl00_cphRoblox_Forumgrouprepeater1_ctl01_ForumGroup">
			<td class="forumHeaderBackgroundAlternate" colspan="5" height="20">
				<a id="ctl00_cphRoblox_Forumgrouprepeater1_ctl01_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a>
			</td>
		</tr>
		<?php
		$forums = $group->getForumsInGroup();
		foreach ($forums as $forum):
		?>
		<tr>
			<td class="forumRow" align="center" valign="top" width="34" nowrap="nowrap">
				<img src="/Forum/skins/default/images/forum_status.gif" width="34" border="0">
			</td>
			<td class="forumRow" width="80%">
				<a class="forumTitle" href="/Forum/ShowForum.aspx?ForumID=<?=$forum->getId()?>"><?=htmlspecialchars(Helper::debugString($forum->getTopic()))?></a>
				<span class="normalTextSmall">
					<br><?=htmlspecialchars(Helper::debugString($forum->getDescription()))?> </span>
			</td>
			<td class="forumRowHighlight" align="center">
				<span class="normalTextSmaller"><?=$forum->getThreadCount()?></span>
			</td>
			<td class="forumRowHighlight" align="center">
				<span class="normalTextSmaller"><?=$forum->getPostCount()?></span>
			</td>
			<td class="forumRowHighlight" align="center">
				<?php if ($forum->getPostCount() > 0): ?>
				<span class="normalTextSmaller">
					<span>
						<b><?=$forum->formatTime($forum->getLastPostTime())?></b>
					</span>
				</span>
				<br>
				<span class="normalTextSmaller">by <a style="overflow-wrap:anywhere" href="/Forum/User/UserProfile.aspx?UserName=<?=$forum->getLastPoster()->getUsername()?>"><?=$forum->getLastPoster()->getUsername()?></a>
					<a href="/Forum/ShowPost.aspx?PostID=<?=$forum->getLastPostId()?>#1203476">
						<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
					</a>
				</span>
				<?php else: ?>
				<span class="normalTextSmaller">
					<span>
						<b>N/A</b>
					</span>
				</span>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<p>
	<span id="ctl00_cphRoblox_Whereami2"></span>
</p>
<?=PageBuilder::addComponent("forum", "whereamifull")?>
<span id="ctl00_cphRoblox_Whereami2_ctl00_MenuScript"></span>
<p></p>
</td>
<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
<!-- right margin -->
<td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>

<?php
PageBuilder::addComponent("forum", "footer");
?>