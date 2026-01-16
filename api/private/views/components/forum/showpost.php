<?php
global $db, $thread;

PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>
									<span id="ctl00_cphRoblox_PostView1">
										<table cellpadding="0" width="100%">
											<tbody>
												<tr>
													<td align="left" colspan="2">
														<?=PageBuilder::addComponent("forum", "whereami")?>
													</td>
												</tr>
												<tr>
													<td align="left" colspan="2">&nbsp; </td>
												</tr>
												<tr>
													<td valign="top" align="left">
														<span class="normalTextSmallBold"></span>
													</td>
													<td valign="bottom" align="right">
														<span class="normalTextSmallBold">Display using: </span>
														<select name="ctl00$cphRoblox$PostView1$ctl00$DisplayMode" id="ctl00_cphRoblox_PostView1_ctl00_DisplayMode">
															<option selected="selected" value="Flat">Flat View</option>
															<option value="Threaded">Threaded View</option>
														</select>&nbsp; <select name="ctl00$cphRoblox$PostView1$ctl00$SortOrder" id="ctl00_cphRoblox_PostView1_ctl00_SortOrder">
															<option selected="selected" value="0">Oldest to newest</option>
															<option value="1">Newest to oldest</option>
														</select>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<table id="ctl00_cphRoblox_PostView1_ctl00_PostList" class="tableBorder" cellspacing="1" cellpadding="0" border="0" width="100%">
															<tbody>
																<tr>
																	<td class="forumHeaderBackgroundAlternate" colspan="2" height="20">
																		<table cellspacing="0" cellpadding="0" border="0" width="100%">
																			<tbody>
																				<tr>
																					<td align="left"></td>
																					<td align="right">
																						<a id="ctl00_cphRoblox_PostView1_ctl00_PostList_ctl00_PreviousThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$PostList$ctl00$PreviousThread','')">Previous Thread</a>&nbsp; <span class="normalTextSmallBold">::</span>&nbsp; <a id="ctl00_cphRoblox_PostView1_ctl00_PostList_ctl00_NextThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$PostList$ctl00$NextThread','')">Next Thread</a>&nbsp;
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr>
																	<th class="tableHeaderText" align="left" height="25" width="100">&nbsp;Author</th>
																	<th class="tableHeaderText" align="left" width="85%">&nbsp;Thread: <?=htmlspecialchars($thread->getTitle())?></th>
																</tr>
																<?php 
																$totalPosts = $thread->countReplies() + 1;
																$pages = ceil($totalPosts / 25);
																$page = isset($_GET["PageIndex"]) ? (int)$_GET["PageIndex"] : 1;
																if (isset($_POST["__EVENTTARGET"])) {
																	if (str_starts_with($_POST["__EVENTTARGET"], 'ctl00$cphRoblox$PostView1$ctl00$Pager$')) {
																		$page = explode('$', $_POST["__EVENTTARGET"])[5];
																		if ($page == "Next") {
																			$page = $page + 1;
																		} else {
																			$page = (int)explode("Page", $page)[1];
																		}
																	}
																}

																$offset = ($page - 1) * 25; # ThePlayerRolo this is the only way to calculate offsets Frick laravel

																$replies = $thread->getReplies(25, $offset);
																if ($page == 1) {
																	array_unshift($replies, $thread);
																}

																if ($replies):
																foreach ($replies as $count => $reply): ?>
																<tr>
																	<td class="forum<?=$count % 2 == 0 ? "Alternate" : "Row"?>" valign="top" nowrap="nowrap">
																		<table border="0">
																			<tbody>
																				<tr>
																					<td>
																						<img src="/Forum/skins/default/images/user_Is<?=$reply->getAuthor()->isOnline() ? "Online" : "Offline"?>.gif" border="0">&nbsp; <a class="normalTextSmallBold" href="/Forum/User/UserProfile.aspx?UserName=<?=$reply->getAuthor()->getUsername()?>"><?=$reply->getAuthor()->getUsername()?></a>
																						<br>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<a href="/User.aspx?ID=<?=$reply->getAuthor()->getUserId()?>">
																							<img style="width:64px;height:64px;" src="<?=$reply->getAuthorBust()?>" border="0">
																						</a>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span class="normalTextSmaller">
																							<b>Joined:</b> <?=$reply->getAuthor()->joinDate()->format("j M Y")?> </span>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span class="normalTextSmaller">
																							<b>Total Posts: </b><?=$reply->getAuthor()->getForumPosts(NULL, true)?> </span>
																					</td>
																				</tr>
																				<tr>
																					<td>&nbsp;</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																	<td class="forum<?=$count % 2 == 0 ? "Alternate" : "Row"?>" valign="top">
																		<table cellspacing="0" width="100%" cellpadding="3" border="0">
																			<tbody>
																				<tr>
																					<td class="forumRowHighlight">
																						<span class="normalTextSmallBold"><?=htmlspecialchars($reply->getTitle())?> <a name="<?=$reply->getId()?>"></a>
																						</span>
																						<a name="<?=$reply->getId()?>">
																							<br>
																							<span class="normalTextSmaller"> Posted: </span>
																							<span class="normalTextSmaller"><?=$reply->getPostDate()->format("m-d-Y h:i A")?></span>
																						</a>
																					</td>
																				</tr>
																				<tr>
																					<td colspan="2">
																						<span class="normalTextSmall"><?=htmlspecialchars($reply->getContent())?></span>
																					</td>
																				</tr>
																				<tr>
																					<td colspan="2">
																						<span class="normalTextSmaller"></span>
																					</td>
																				</tr>
																				<tr>
																					<td height="2"></td>
																				</tr>
																				<tr>
																					<td colspan="2">
																						<a href="/Forum/AddPost.aspx?PostID=<?=$reply->getId()?>&amp;mode=flat">
																							<img border="0" src="/Forum/skins/default/images/newpost.gif">
																						</a>
																						<a href="/AbuseReport/ForumPost.aspx?PostID=<?=$reply->getId()?>&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fForum%2fShowPost.aspx%3fPostID%3d1964006">Report Abuse</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<?php endforeach; endif; ?>
																<tr>
																	<td class="forumHeaderBackgroundAlternate" colspan="2" height="20"><table cellspacing="0" cellpadding="0" border="0" width="100%">
																		<tbody><tr>
																			<td align="left"></td><td align="right"><a id="ctl00_cphRoblox_PostView1_ctl00_PostList_ctl02_PreviousThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$PostList$ctl02$PreviousThread','')">Previous Thread</a>&nbsp;<span class="normalTextSmallBold">::</span>&nbsp;<a id="ctl00_cphRoblox_PostView1_ctl00_PostList_ctl02_NextThread" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$PostList$ctl02$NextThread','')">Next Thread</a>&nbsp;</td>
																		</tr>
																	</tbody></table></td>
																</tr>
															</tbody>
														</table>
														<span id="ctl00_cphRoblox_PostView1_ctl00_Pager">
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
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Pager_Page<?=$i?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$Pager$Page<?=$i?>','')"><?=$i?></a><?php if ($i < $pages && $i !== 3): ?><span class="normalTextSmallBold">, </span>
																				<?php endif; endif; ?>
																				<?php if ($i == 4 && $pages > 5): ?>
																				<span class="normalTextSmallBold"> ... </span>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Pager_Page<?=$pages - 1?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$Pager$Page<?=$pages - 1?>','')"><?=$pages - 1?></a>
																				<span class="normalTextSmallBold">, </span>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Pager_Page<?=$pages?>" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$Pager$Page<?=$pages?>','')"><?=$pages?></a>
																				<span class="normalTextSmallBold">&nbsp;</span>
																				<?php endif; endfor; ?>
																				<?php if ($pages > 3): ?>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Pager_Next" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$PostView1$ctl00$Pager$Next','')">Next</a>
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
													<td colspan="2">&nbsp;</td>
												</tr>
												<tr>
													<td align="left" colspan="2"></td>
												</tr>
												<tr>
													<td align="left" colspan="2"><?=PageBuilder::addComponent("forum", "whereami")?></td>
												</tr>
											</tbody>
										</table>
									</span>
								</td>
								<?=PageBuilder::addComponent("forum", "footer")?>