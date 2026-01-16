<?php
PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
global $forum, $user;
?>

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
					<a id="ctl00_cphRoblox_ThreadView1_ctl00_NewThreadLinkTop" href="/Forum/AddPost.aspx?ForumID=<?=$forum->getId()?>">
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
                            $totalThreads = $forum->getThreadCount();
							$pages = ceil($totalThreads / 12);
							$page = isset($_GET["PageIndex"]) ? (int)$_GET["PageIndex"] : 1;
							if (isset($_POST["__EVENTTARGET"])) {
								if (str_starts_with($_POST["__EVENTTARGET"], 'ctl00$cphRoblox$ThreadView1$ctl00$Pager$')) {
									$page = explode('$', $_POST["__EVENTTARGET"])[5];
									if ($page == "Next") {
										$page = $page + 1;
									} else {
										$page = (int)explode("Page", $page)[1];
									}
								}
							}

							$offset = ($page - 1) * 12;
                            $posts = $forum->getPosts($page);

                            foreach ($posts as $post):
                                $thread = new Thread($post["postId"]);
                            ?>
							<tr>
								<td class="forumRow" align="center" valign="middle" width="25">
                                    <?php if ($thread->viewCount() > 100): ?>
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
									<span class="normalTextSmaller"><?=$thread->countReplies()?></span>
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
										<span class="normalTextSmallBold">Page <?=$page?> of <?=$pages?></span>
									</td>
									<?php if ($pages > 1): ?>
									<td align="right">
										<span>
											<span class="normalTextSmallBold">Goto to page: </span>
											<?php for ($i = 1; $i <= $pages; $i++): ?>
											<?php if ($i <= 3): ?>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page<?=$i?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page<?=$i?>','')"><?=$i?></a><?php if ($i < $pages && $i !== 3): ?><span class="normalTextSmallBold">, </span>
											<?php endif; endif; ?>
											<?php if ($i == 4 && $pages > 5): ?>
											<span class="normalTextSmallBold"> ... </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page<?=$pages - 1?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page<?=$pages - 1?>','')"><?=$pages - 1?></a>
											<span class="normalTextSmallBold">, </span>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page<?=$pages?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Page<?=$pages?>','')"><?=$pages?></a>
											<span class="normalTextSmallBold">&nbsp;</span>
											<?php endif; endfor; ?>
											<?php if ($pages > 3): ?>
											<a id="ctl00_cphRoblox_ThreadView1_ctl00_Pager_Next" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$ThreadView1$ctl00$Pager$Next','')">Next</a>
											<?php endif; ?>
										</span>
									</td>
									<?php endif; ?>
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
					<?=PageBuilder::addComponent("forum", "whereamifull")?>
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

<?php
PageBuilder::addComponent("forum", "footer");
?>