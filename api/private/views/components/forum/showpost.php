<?php
global $db, $thread;
?>

<div id="Body">
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td></td>
			</tr>
			<tr valign="bottom">
				<td>
					<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr valign="top">
								<!-- left column -->
								<td>&nbsp; &nbsp; &nbsp;</td>
								<!-- center column -->
								<td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn">
									<br>
									<?=PageBuilder::addComponent("forum", "navmenu")?>
									<span id="ctl00_cphRoblox_PostView1">
										<table cellpadding="0" width="100%">
											<tbody>
												<tr>
													<td align="left" colspan="2">
														<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1" name="Whereami1">
															<table cellpadding="0" cellspacing="0" width="100%">
																<tbody>
																	<tr>
																		<td valign="top" align="left" width="1px">
																			<nobr></nobr>
																		</td>
																		<td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumGroupMenu" class="popupMenuSink" valign="top" align="left" width="1px">
																			<nobr>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a>
																			</nobr>
																		</td>
																		<td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumMenu" class="popupMenuSink" valign="top" align="left" width="1px">
																			<nobr>
																				<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_ForumSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkForum" class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=13">General Discussion</a>
																			</nobr>
																		</td>
																		<td id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostMenu" class="popupMenuSink" valign="top" align="left" width="1px">
																			<nobr>
																				<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_PostSeparator" class="normalTextSmallBold">&nbsp;&gt;</span>
																				<a id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_LinkPost" class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=1964006">Err...</a>
																			</nobr>
																		</td>
																		<td valign="top" align="left" width="*">&nbsp;</td>
																	</tr>
																</tbody>
															</table>
															<span id="ctl00_cphRoblox_PostView1_ctl00_Whereami1_ctl00_MenuScript"></span>
														</span>
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
																						<img src="/Forum/skins/default/images/user_IsOnline.gif" alt="chrisishappy132 is online. Last active: 7/24/2008 11:20:25 AM" border="0">&nbsp; <a class="normalTextSmallBold" href="/User.aspx?username=chrisishappy132"><?=$thread->getAuthor()->getUsername()?></a>
																						<br>
																					</td>
																				</tr>
																				<tr>
																					<td>
																						<a href="/User.aspx?username=chrisishappy132">
																							<img src="<?=$thread->getAuthorBust()?>" border="0">
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
																							<b>Total Posts: </b>584 </span>
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
																						<span class="normalTextSmallBold"><?=htmlspecialchars($thread->getTitle())?><a name="1964006"></a>
																						</span>
																						<a name="1964006">
																							<br>
																							<span class="normalTextSmaller"> Posted: </span>
																							<span class="normalTextSmaller"><?=$thread->getPostDate()->format("j M Y g:i A")?></span>
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
																						<a href="/Forum/AddPost.aspx?PostID=1964167&amp;mode=flat">
																							<img border="0" src="/Forum/skins/default/images/newpost.gif">
																						</a>
																						<a href="/AbuseReport/ForumPost.aspx?PostID=1964006&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fForum%2fShowPost.aspx%3fPostID%3d1964006">Report Abuse</a>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table><span id="ctl00_cphRoblox_PostView1_ctl00_Pager"><table cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td><span class="normalTextSmallBold">Page 1 of 1</span></td></tr></tbody></table></span>
													</td>
												</tr><tr><td colspan="2">&nbsp;</td></tr><tr><td align="left" colspan="2"></td></tr><tr><td align="left" colspan="2"><span id="ctl00_cphRoblox_PostView1_ctl00_Whereami2" name="Whereami2"><table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td valign="top" align="left" width="1px"><nobr><a id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_LinkHome" class="linkMenuSink" href="/Forum/Default.aspx">ROBLOX Forum</a></nobr></td><td id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_ForumGroupMenu" class="popupMenuSink" valign="top" align="left" width="1px"><nobr><span id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold">&nbsp;&gt;</span><a id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_LinkForumGroup" class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a></nobr></td><td id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_ForumMenu" class="popupMenuSink" valign="top" align="left" width="1px"><nobr><span id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_ForumSeparator" class="normalTextSmallBold">&nbsp;&gt;</span><a id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_LinkForum" class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=13">General Discussion</a></nobr></td><td id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_PostMenu" class="popupMenuSink" valign="top" align="left" width="1px"><nobr><span id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_PostSeparator" class="normalTextSmallBold">&nbsp;&gt;</span><a id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_LinkPost" class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=1964006">Err...</a></nobr></td><td valign="top" align="left" width="*">&nbsp;</td></tr></tbody></table><span id="ctl00_cphRoblox_PostView1_ctl00_Whereami2_ctl00_MenuScript"></span></span></td></tr>
											</tbody>
										</table>
									</span>
								</td><td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
								<!-- right margin --><td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>