<?php
global $db, $thread, $user;

PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");
?>

<span id="ctl00_cphRoblox_Createeditpost1" name="Createeditpost1">
	<table cellspacing="0" border="0">
		<tbody>
			<tr>
				<td>
					<?=PageBuilder::addComponent("forum", "whereamifull")?>
				</td>
			</tr>
		</tbody>
	</table>
	<p></p>
	<span id="ctl00_cphRoblox_Createeditpost1_PostForm_Post"></span>
	<table class="tableBorder" cellspacing="1" cellpadding="3" width="100%">
		<tbody>
			<tr>
				<th class="tableHeaderText" align="left" height="25"> &nbsp; <span id="ctl00_cphRoblox_Createeditpost1_PostForm_PostTitle"><?php if (isset($_GET["PostID"])): ?> Reply to an Existing Message <?php else: ?> Post a New Message <?php endif; ?></span>
				</th>
			</tr>
			<tr>
				<td class="forumRow">
					<?php if (isset($_GET["PostID"])): $thread = new Thread($_GET["PostID"])?>
					The message you are replying to:
					<table cellspacing="1" cellpadding="3">
						<tbody>
							<tr>
								<td valign="top" nowrap="" align="right">
									<span class="normalTextSmallBold">Posted By: </span>
								</td>
								<td valign="top" align="left" colspan="2">
									<span class="normalTextSmall">
										<span id="ctl00_cphRoblox_Createeditpost1_PostForm_PostAuthor"><a href="/User.aspx?ID=<?=$thread->getAuthor()->getUserId()?>"><?=$thread->getAuthor()->getUsername()?></a> on <?=$thread->getPostDate()->format("m-d-Y h:i A")?></span>
									</span>
								</td>
							</tr>
							<tr>
								<td nowrap="" valign="middle" align="right">
									<span class="normalTextSmallBold">Subject: </span>
								</td>
								<td valign="top" align="left" colspan="2">
									<span class="normalTextSmall"><a href="/Forum/ShowPost.aspx?PostID=<?=$thread->getId()?>"><?=htmlspecialchars($thread->getTitle())?></a></span>
								</td>
							</tr>
							<tr>
								<td nowrap="" valign="middle" align="right">
									<span class="normalTextSmallBold">Message: </span>
								</td>
								<td valign="top" align="left" colspan="2">
									<span class="normalTextSmall"><?=htmlspecialchars($thread->getContent())?></span>
								</td>
							</tr>
						</tbody>
					</table>
					<br><br>
					<?php endif; ?>
					<table cellspacing="1" cellpadding="3">
						<tbody>
							<tr>
								<td valign="top" nowrap="" align="right">
									<span class="normalTextSmallBold">Author: </span>
								</td>
								<td valign="top" align="left" colspan="2">
									<span class="normalTextSmall">
										<span id="ctl00_cphRoblox_Createeditpost1_PostForm_PostAuthor"><?=$user->getUsername()?></span>
									</span>
								</td>
							</tr>
							<tr>
								<td nowrap="" valign="middle" align="right">
									<span class="normalTextSmallBold">Subject: </span>
								</td>
								<td valign="top" align="left">
									<input name="ctl00$cphRoblox$Createeditpost1$PostForm$PostSubject" type="text" size="55" id="ctl00_cphRoblox_Createeditpost1_PostForm_PostSubject" autocomplete="off" value="<?=isset($_GET["PostID"]) ? "RE " . htmlspecialchars($thread->getTitle()) : ""?>">
								</td>
								<td>
									<span id="ctl00_cphRoblox_Createeditpost1_PostForm_RequiredFieldValidator1" class="validationWarningSmall" style="color:Red;<?=isset($_GET["Error"]) ? "visibility:visible;" : "visibility:hidden;"?>">
										<?php if (isset($_GET["Error"])): 
										if ($_GET["Error"] == "NoSubject"): ?>
										Subject required.
										<?php elseif ($_GET["Error"] == "LongSubject"): ?>
										Subject cannot exceed 40 characters.
										<?php endif; endif ?>
									</span>
								</td>
							</tr>
							<tr>
								<td valign="top" nowrap="" align="right">
									<span class="normalTextSmallBold">Message: </span>
								</td>
								<td valign="top" align="left">
									<textarea name="ctl00$cphRoblox$Createeditpost1$PostForm$PostBody" rows="20" cols="90" id="ctl00_cphRoblox_Createeditpost1_PostForm_PostBody"></textarea>
								</td>
								<td valign="top">&nbsp;</td>
							</tr>
							<tr>
								<td valign="middle" align="right" width="93">
									<span class="normalTextSmallBold">&nbsp;</span>
								</td>
								<td valign="top" align="left">
									<span class="normalTextSmall">
										<input id="ctl00_cphRoblox_Createeditpost1_PostForm_AllowReplies" type="checkbox" name="ctl00$cphRoblox$Createeditpost1$PostForm$AllowReplies">
										<label for="ctl00_cphRoblox_Createeditpost1_PostForm_AllowReplies"> Do not allow replies to this post.</label>
									</span>
								</td>
							</tr>
							<tr>
								<td valign="top" align="right" colspan="2">
									<input type="submit" name="ctl00$cphRoblox$Createeditpost1$PostForm$Cancel" value=" Cancel " id="ctl00_cphRoblox_Createeditpost1_PostForm_Cancel">&nbsp; <input type="submit" name="ctl00$cphRoblox$Createeditpost1$PostForm$PreviewButton" value=" Preview &gt; " onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$Createeditpost1$PostForm$PreviewButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_cphRoblox_Createeditpost1_PostForm_PreviewButton">
								</td>
							</tr>
							<tr>
								<td valign="top" align="right" colspan="2">
									<input type="submit" name="ctl00$cphRoblox$Createeditpost1$PostForm$PostButton" value=" Post " onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$Createeditpost1$PostForm$PostButton&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_cphRoblox_Createeditpost1_PostForm_PostButton">
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
	<table cellspacing="0" border="0">
		<tbody>
			<tr>
				<td>
					<?=PageBuilder::addComponent("forum", "whereamifull")?>
				</td>
			</tr>
		</tbody>
	</table>
	<p></p>
</span>

<?=PageBuilder::addComponent("forum", "footer")?>