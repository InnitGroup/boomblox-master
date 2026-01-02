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
																<tr>
																	<td class="forumRow" valign="top" width="150" nowrap="nowrap">
																		<table border="0">
																			<tbody>
																				<tr>
																					<td>
																						<img src="/Forum/skins/default/images/user_Is<?=$thread->getAuthor()->isOnline() ? "Online" : "Offline"?>.gif" border="0">&nbsp; <a class="normalTextSmallBold" href="/User.aspx?username=<?=$thread->getAuthor()->getUsername()?>"><?=$thread->getAuthor()->getUsername()?></a>
																						<br>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<a href="/User.aspx?username=<?=$thread->getAuthor()->getUsername()?>">
																							<img style="width:64px;height:64px;" src="<?=$thread->getAuthorBust()?>" border="0">
																						</a>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span class="normalTextSmaller">
																							<b>Joined:</b> <?=$thread->getAuthor()->joinDate()->format("j M Y")?> </span>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<span class="normalTextSmaller">
																							<b>Total Posts: </b><?=$thread->getAuthor()->getForumPosts(NULL, true)?> </span>
																					</td>
																				</tr>
																				<tr>
																					<td>&nbsp;</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																	<td class="forumRow" valign="top">
																		<table cellspacing="0" cellpadding="3" border="0" width="100%">
																			<tbody>
																				<tr>
																					<td class="forumRowHighlight">
																						<span class="normalTextSmallBold"><?=htmlspecialchars($thread->getTitle())?><a name="<?=$thread->getId()?>"></a>
																						</span>
																						<a name="<?=$thread->getId()?>">
																							<br>
																							<span class="normalTextSmaller"> Posted: </span>
																							<span class="normalTextSmaller"><?=$thread->getPostDate()->format("m-d-Y h:i A")?></span>
																						</a>
																					</td>
																				</tr>
																				<tr>
																					<td colspan="2">
																						<span class="normalTextSmall"><?=htmlspecialchars($thread->getContent())?></span>
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
																						<a href="/Forum/AddPost.aspx?PostID=<?=$thread->getId()?>&amp;mode=flat">
																							<img border="0" src="/Forum/skins/default/images/newpost.gif">
																						</a>
																						<a href="/AbuseReport/ForumPost.aspx?PostID=<?=$thread->getId()?>&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fForum%2fShowPost.aspx%3fPostID%3d1964006">Report Abuse</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<?php if ($replies = $thread->getReplies()):
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
														</table><span id="ctl00_cphRoblox_PostView1_ctl00_Pager"><table cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td><span class="normalTextSmallBold">Page 1 of 1</span></td></tr></tbody></table></span>
													</td>
												</tr><tr><td colspan="2">&nbsp;</td></tr><tr><td align="left" colspan="2"></td></tr><tr><td align="left" colspan="2"><?=PageBuilder::addComponent("forum", "whereami")?></td></tr>
											</tbody>
										</table>
									</span>
								</td>
								<?=PageBuilder::addComponent("forum", "footer")?>