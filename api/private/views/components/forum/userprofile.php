<?php
global $db;

$username = isset($_GET["UserName"]) ? $_GET["UserName"] : Server::_404();
$userId = $db->getIdByUser($username);
$profiledUser = new User($userId);
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
								<td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn"> &nbsp; <br>
									<?=PageBuilder::addComponent("forum", "navmenu")?>
									<p>
										<span id="ctl00_cphRoblox_Userinfo1" name="Userinfo1"></span>
									</p>
									<table cellspacing="1" cellpadding="0" width="100%" class="tableBorder">
										<tbody>
											<tr>
												<th height="25" class="tableHeaderText" align="left" colspan="2"> &nbsp; Viewing User Profile for: <span id="ctl00_cphRoblox_Userinfo1_ctl00_Username"><?=$profiledUser->getUsername()?></span>
												</th>
											</tr>
											<tr>
												<td height="20" class="forumHeaderBackgroundAlternate">
													<span class="forumTitle"> &nbsp;About </span>
												</td>
												<td class="forumHeaderBackgroundAlternate">
													<span class="forumTitle"> &nbsp;Contact </span>
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" class="forumRow" width="50%">
													<table cellpadding="4">
														<tbody>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Joined: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_Joined"><?=$profiledUser->joinDate()->format("m-d-Y h:i A")?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Last Login: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_LastLogin"><?=$profiledUser->lastDate()->format("m-d-Y h:i A")?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Website: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<a id="ctl00_cphRoblox_Userinfo1_ctl00_WebSite" target="_blank"><?=$profiledUser->getWebsite() !== NULL && !empty($profiledUser->getWebsite()) ? htmlspecialchars($profiledUser->getWebsite()) : ""?></a>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Location: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_Location"><?=$profiledUser->getLocation() !== NULL && !empty($profiledUser->getLocation()) ? htmlspecialchars($profiledUser->getLocation()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Occupation: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_Occupation"><?=$profiledUser->getOccupation() !== NULL && !empty($profiledUser->getOccupation()) ? htmlspecialchars($profiledUser->getOccupation()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Interests: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_Interests"><?=$profiledUser->getInterests() !== NULL && !empty($profiledUser->getInterests()) ? htmlspecialchars($profiledUser->getInterests()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Signature: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_Signature"><?=$profiledUser->getSignature() !== NULL && !empty($profiledUser->getSignature()) ? htmlspecialchars($profiledUser->getSignature()) : ""?></span>
																	</span>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
												<td valign="top" class="forumRow" width="50%">
													<table cellpadding="4">
														<tbody>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Email: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<a id="ctl00_cphRoblox_Userinfo1_ctl00_Email" target="_blank"><?=$profiledUser->getPemail() !== NULL && !empty($profiledUser->getPemail()) ? htmlspecialchars($profiledUser->getPemail()) : "N/A"?></a>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> MSN IM: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_MsnIm"><?=$profiledUser->getMSN() !== NULL && !empty($profiledUser->getMSN()) ? htmlspecialchars($profiledUser->getMSN()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> AIM: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_AolIm"><?=$profiledUser->getAIM() !== NULL && !empty($profiledUser->getAIM()) ? htmlspecialchars($profiledUser->getAIM()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> Yahoo IM: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_YahooIm"><?=$profiledUser->getYahoo() !== NULL && !empty($profiledUser->getYahoo()) ? htmlspecialchars($profiledUser->getYahoo()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="right">
																	<span class="normalTextSmallBold"> ICQ: </span>
																</td>
																<td valign="top" align="left">
																	<span class="normalTextSmall">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_ICQ"><?=$profiledUser->getICQ() !== NULL && !empty($profiledUser->getICQ()) ? htmlspecialchars($profiledUser->getICQ()) : "N/A"?></span>
																	</span>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="20" class="forumHeaderBackgroundAlternate" colspan="2">
													<span class="forumTitle"> &nbsp;Post Statistics </span>
												</td>
											</tr>
											<tr>
												<td class="forumRow" valign="top" colspan="2">
													<table width="100%" cellpadding="4">
														<tbody>
															<tr>
																<td valign="top" align="left">
																	<span class="normalTextSmallBold">
																		<span id="ctl00_cphRoblox_Userinfo1_ctl00_PostStats"><?=$profiledUser->getUsername()?> has contributed to <?=number_format(Forum::countAllPostsByUser($profiledUser->getUserId()))?> out of <?=number_format(Forum::countAllPosts())?> total posts (<?=number_format((Forum::countAllPostsByUser($profiledUser->getUserId())/Forum::countAllPosts())*100, 2)?>% of total).</span>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="left">
																	<span class="normalTextSmallBold"> Most Recent Posts: </span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="left" colspan="2">
																	<?php 
																	$recentPosts = $profiledUser->getForumPosts(10);
																	if (!empty($recentPosts)): ?>
																	<table id="ctl00_cphRoblox_Userinfo1_ctl00_PostList" cellspacing="1" cellpadding="3" border="0" width="100%">
																		<tbody>
																			<tr>
																				<td>
																					<table width="100%" cellpadding="0" cellspacing="0">
																						<tbody>
																							<?php
																							foreach ($recentPosts as $relativeId => $recentPost): ?>
																							<tr>
																								<td>
																									<table width="100%" cellpadding="0" cellspacing="0">
																										<tbody>
																											<tr>
																												<td <?=$relativeId % 2 == 0 ? 'class="forumAlternate"' : ''?>>
																													<a class="linkSmallBold" href="/Forum/ShowPost.aspx?PostID=<?=$recentPost->isAReply() ? $recentPost->parentPost() . "#" . $recentPost->getId() : $recentPost->getId()?>"><?=htmlspecialchars(Helper::debugString($recentPost->getTitle()))?></a>
																													<span class="normalTextSmall">
																														<i><?=$recentPost->formatPostDate()?></i> <!-- 6/3/2008 8:23:42 AM -->
																													</span> &nbsp; <span class="normalTextSmall">(Total replies: <?=$recentPost->countReplies()?>)</span>
																												</td>
																											</tr>
																											<tr>
																												<td <?=$relativeId % 2 == 0 ? 'class="forumAlternate"' : ''?>>
																													<span class="normalTextSmall"><?=htmlspecialchars(Helper::debugString($recentPost->getContent()))?></span>
																												</td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																							</tr>	
																							<?php if (count($recentPosts) !== $relativeId): ?>
																								<tr>
																									<td>
																										<hr size="1">
																									</td>
																								</tr>
																								<?php endif; endforeach; ?>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<?php endif; ?>
																	<p>
																		<a id="ctl00_cphRoblox_Userinfo1_ctl00_MorePosts" class="linkSmallBold" href="/Forum/Search/default.aspx?SearchFor=1&amp;SearchText=<?=$profiledUser->getUsername()?>">Search for more...</a>
																	</p>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<p></p>
									<p></p>
								</td>
								<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
								<!-- right margin -->
								<td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>