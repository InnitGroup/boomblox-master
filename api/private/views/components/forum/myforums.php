<?php
global $user;
PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>

<span id="ctl00_cphRoblox_MyForums1">
	<table cellpadding="0" width="100%">
		<tbody>
			<tr>
				<td align="left" colspan="2">
					<?=PageBuilder::addComponent("forum", "whereamifull")?>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="2">&nbsp; </td>
			</tr>
			<tr>
				<td colspan="2">
					<span class="menuTitle">Threads you are tracking:</span>
					<table id="ctl00_cphRoblox_MyForums1_ctl00_ThreadTracking" class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
						<tbody>
							<tr>
								<th class="tableHeaderText" align="left" colspan="2" style="height:25px;">&nbsp;Thread&nbsp;</th>
								<th class="tableHeaderText" align="center" style="white-space:nowrap;">&nbsp;Started By&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Replies&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Views&nbsp;</th>
								<th class="tableHeaderText" align="center" style="white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=44578612">Donating to other players</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Shooter455">Shooter455</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">13</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">71</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-14-2011 03:40 AM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Epicsauceofketchup">Epicsauceofketchup</a>
									<a href="/Forum/ShowPost.aspx?PostID=44578612#47042085">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=47026068">The population is droping!</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Someone7777">Someone7777</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">21</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">177</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-13-2011 07:58 PM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=megazone2000">megazone2000</a>
									<a href="/Forum/ShowPost.aspx?PostID=47026068#47030593">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumHeaderBackgroundAlternate" colspan="6">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<br>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="2">&nbsp; </td>
			</tr>
			<tr>
				<td colspan="2">
					<span class="menuTitle">Last 25 active threads you have participated in:</span>
					<table id="ctl00_cphRoblox_MyForums1_ctl00_ParticipatedThreads" class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
						<tbody>
							<tr>
								<th class="tableHeaderText" align="left" colspan="2" style="height:25px;">&nbsp;Thread&nbsp;</th>
								<th class="tableHeaderText" align="center" style="white-space:nowrap;">&nbsp;Started By&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Replies&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Views&nbsp;</th>
								<th class="tableHeaderText" align="center" style="white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
							</tr>
							<?php
							$posts = $user->getForumPosts(25);
							if ($posts !== 0):
								foreach ($posts as $post):
							?>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=<?=$post->getId()?>"><?=htmlspecialchars($post->getTitle())?></a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=<?=$post->getAuthor()->getUsername()?>"><?=$post->getAuthor()->getUsername()?></a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">-</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller"><?=count($post->getViews())?></span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">
										<b><?=$post->formatLastActivity()?></b>
										<br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
									<a href="/Forum/ShowPost.aspx?PostID=<?=$post->getId()?>#47631015">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<?php endforeach; else: ?>
								no threads 
							<?php endif; ?>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=47313271">Adding two things</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">-</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">8</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-20-2011 04:11 PM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
									<a href="/Forum/ShowPost.aspx?PostID=47313271#47313271">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=47019067">Technical center</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">11</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">79</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-14-2011 10:16 AM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
									<a href="/Forum/ShowPost.aspx?PostID=47019067#47056264">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=44578612">Donating to other players</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Shooter455">Shooter455</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">13</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">71</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-14-2011 03:40 AM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Epicsauceofketchup">Epicsauceofketchup</a>
									<a href="/Forum/ShowPost.aspx?PostID=44578612#47042085">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=47026068">The population is droping!</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Someone7777">Someone7777</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">21</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">177</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-13-2011 07:58 PM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=megazone2000">megazone2000</a>
									<a href="/Forum/ShowPost.aspx?PostID=47026068#47030593">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Post" src="/Forum/skins/default/images/topic.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=44580530">Why cant we(not BC,TBC,or OBC)sell shirt`s?</a>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">15</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">74</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">05-13-2011 05:25 PM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=punkster1234567">punkster1234567</a>
									<a href="/Forum/ShowPost.aspx?PostID=44580530#47018683">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumRow" align="center" valign="middle" style="width:25px;">
									<img title="Popular post" src="/Forum/skins/default/images/topic-popular.gif" style="border-width:0px;">
								</td>
								<td class="forumRow" style="height:25px;">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=43376176">How do I make an mobel on ROBLOX if Im not BC?</a>
									<span class="normalTextSmall"> (Page: </span>
									<a class="linkSmall" href="/Forum/ShowPost.aspx?PostID=43376176&amp;PageIndex=1">1</a>
									<span class="normalTextSmall">, </span>
									<a class="linkSmall" href="/Forum/ShowPost.aspx?PostID=43376176&amp;PageIndex=2">2</a>
									<span class="normalTextSmall">)</span>
								</td>
								<td class="forumRowHighlight" align="left" style="width:100px;">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=Cubut">Cubut</a>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">26</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:50px;">
									<span class="normalTextSmaller">160</span>
								</td>
								<td class="forumRowHighlight" align="center" style="width:140px;white-space:nowrap;">
									<span class="normalTextSmaller">03-02-2011 05:40 PM <br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=zerovelocity">zerovelocity</a>
									<a href="/Forum/ShowPost.aspx?PostID=43376176&amp;PageIndex=2#43378037">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
							<tr>
								<td class="forumHeaderBackgroundAlternate" colspan="6">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<br>
				</td>
			</tr>
			<tr>
				<td align="right" colspan="2">
					<a id="ctl00_cphRoblox_MyForums1_ctl00_FindMorePosts" class="linkSmallBold" href="/Forum/Search/default.aspx?SearchFor=1&amp;SearchText=Cubut">View more posts you have participated in</a>
				</td>
			</tr>
		</tbody>
	</table>
</span>

<?=PageBuilder::addComponent("forum", "footer")?>