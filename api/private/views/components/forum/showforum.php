<span id="ctl00_cphRoblox_ThreadView1">
	<table cellpadding="0" width="100%">
		<tbody>
			<tr>
				<td colspan="2" align="left">
					<?=PageBuilder::addComponent("forum", "whereami")?>
				</td>
			</tr>
			<tr>
				<td> &nbsp; </td>
			</tr>
			<tr>
				<td valign="bottom" align="left">
					<a id="ctl00_cphRoblox_ThreadView1_ctl00_NewThreadLinkTop" href="/Forum/AddPost.aspx?ForumID=13">
						<img id="ctl00_cphRoblox_ThreadView1_ctl00_NewThreadImageTop" src="/Forum/skins/default/images/newtopic.gif" border="0">
					</a>
				</td>
				<td align="right">
					<span class="normalTextSmallBold">Search this forum: </span>
					<input name="ctl00$cphRoblox$ThreadView1$ctl00$Search" type="text" id="ctl00_cphRoblox_ThreadView1_ctl00_Search">
					<input type="submit" name="ctl00$cphRoblox$ThreadView1$ctl00$SearchButton" value=" Go " id="ctl00_cphRoblox_ThreadView1_ctl00_SearchButton">
				</td>
			</tr>
			<tr>
				<td valign="top" colspan="2">
					<table id="ctl00_cphRoblox_ThreadView1_ctl00_ThreadList" class="tableBorder" cellspacing="1" cellpadding="3" border="0" width="100%">
						<tbody>
							<tr>
								<th class="tableHeaderText" align="left" colspan="2" height="25">&nbsp;Thread&nbsp;</th>
								<th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Started By&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Replies&nbsp;</th>
								<th class="tableHeaderText" align="center">&nbsp;Views&nbsp;</th>
								<th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
							</tr>

                            <?php
                            global $forum, $user;
                            $posts = $forum->getPosts();

                            foreach ($posts as $post):
                                $thread = new Thread($post["postId"]);
                            ?>
							<tr>
								<td class="forumRow" align="center" valign="middle" width="25">
                                    <?php if ($thread->viewCount() > 1000): ?>
									<img title="Popular post" src="/Forum/skins/default/images/topic-popular.gif" border="0">
                                    <?php endif; if (!in_array($user->getUserId(), $thread->getViews())): ?>
                                    <img title="Post (Not Read)" src="/Forum/skins/default/images/topic_notread.gif" border="0">
                                    <?php else: ?>
                                    <img title="Post" src="/Forum/skins/default/images/topic.gif" border="0"> 
                                    <?php endif; ?>
								</td>
								<td class="forumRow" height="25">
									<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=<?=$thread->getId()?>"><?=$thread->getTitle()?></a>
								</td>
								<td class="forumRowHighlight" align="left" width="100">&nbsp; <a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=<?=$thread->getAuthor()->getUsername()?>"><?=$thread->getAuthor()->getUsername()?></a>
								</td>
								<td class="forumRowHighlight" align="center" width="50">
									<span class="normalTextSmaller">-</span>
								</td>
								<td class="forumRowHighlight" align="center" width="50">
									<span class="normalTextSmaller"><?=$thread->viewCount()?></span>
								</td>
								<td class="forumRowHighlight" align="center" width="140" nowrap="nowrap">
									<span class="normalTextSmaller">
                                        <?php if ($thread->isPinned()): ?>
										<b>Pinned Post</b>
                                        <?php elseif ($thread->postedToday()): ?>
                                        <b><?=$thread->formatLastActivity()?></b>
                                        <?php else: ?>
                                        <?=$thread->formatLastActivity()?>
                                        <?php endif; ?>
										<br>by </span>
									<a class="linkSmall" href="/Forum/User/UserProfile.aspx?UserName=<?=$thread->getAuthor()->getUsername()?>"><?=$thread->getAuthor()->getUsername()?></a>
									<a href="/Forum/ShowPost.aspx?PostID=<?=$thread->getId()?>#<?=$thread->getId()?>">
										<img border="0" src="/Forum/skins/default/images/icon_mini_topic.gif">
									</a>
								</td>
							</tr>
                            <?php endforeach; ?>

							<tr>
								<td class="forumHeaderBackgroundAlternate" colspan="6">&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<span id="ctl00_cphRoblox_ThreadView1_ctl00_Pager">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
							<tbody>
								<tr>
									<td>
										<span class="normalTextSmallBold">Page 1 of 2,641</span>
									</td>
									<td align="right">
										<span>
											<span class="normalTextSmallBold">Goto to page: </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page0" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page0','')">1</a>
											<span class="normalTextSmallBold">, </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page1" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page1','')">2</a>
											<span class="normalTextSmallBold">, </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page2" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page2','')">3</a>
											<span class="normalTextSmallBold"> ... </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page2639" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page2639','')">2,640</a>
											<span class="normalTextSmallBold">, </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page2640" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page2640','')">2,641</a>
											<span class="normalTextSmallBold">&nbsp;</span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Next" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Next','')">Next</a>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="2"> &nbsp; </td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2" name="Whereami2">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<td valign="top" align="left" width="1px">
										<nobr>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkHome" class="linkMenuSink" href="/Forum/Default.aspx">ROBLOX Forum</a>
										</nobr>
									</td>
									<td id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumGroupMenu" class="popupMenuSink" valign="top" align="left" width="1px">
										<nobr>
											<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkForumGroup" class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a>
										</nobr>
									</td>
									<td id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumMenu" class="popupMenuSink" valign="top" align="left" width="1px">
										<nobr>
											<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkForum" class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=13">General Discussion</a>
										</nobr>
									</td>
									<td id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_PostMenu" class="popupMenuSink" valign="top" align="left" width="1px">
										<nobr></nobr>
									</td>
									<td valign="top" align="left" width="*">&nbsp;</td>
								</tr>
							</tbody>
						</table>
						<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_MenuScript"></span>
					</span>
				</td>
				<td align="right">
					<span class="normalTextSmallBold">Display threads for: </span>
					<select name="ctl00$cphRoblox$ThreadView1$ctl00$DisplayByDays" id="ctl00_cphRoblox_ThreadView1_ctl00_DisplayByDays">
						<option selected="selected" value="0">All Days</option>
						<option value="1">Today</option>
						<option value="3">Past 3 Days</option>
						<option value="7">Past Week</option>
						<option value="14">Past 2 Weeks</option>
						<option value="30">Past Month</option>
						<option value="90">Past 3 Months</option>
						<option value="180">Past 6 Months</option>
						<option value="360">Past Year</option>
					</select>
					<br>
					<a id="ctl00_cphRoblox_ThreadView1_ctl00_MarkAllRead" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$MarkAllRead','')">Mark all threads as read</a>
					<br>
					<span class="normalTextSmallBold"></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp; </td>
			</tr>
		</tbody>
	</table>
</span>