<?php
PageBuilder::addComponent("forum", "header");

$errorId = isset($_GET["MessageID"]) ? $_GET["MessageID"] : 0;

$error = [
    "Unknown error",
    "You are Unable to Administer",
    "You are Unable to Edit this Post",
    "You Are Not Able to Moderate",
    "Attempting to Insert a Duplicate Post",
    "File Not Found",
    "Unknown forum",
    "New Account Created",
    "Post Blocked by ROBLOX Rules",
    "Post Does Not Exist",
];

$errorDesc = [
    "How did you get here",
    "In order to perform any administration duties on this Web site, your user account must be marked as having administrator rights. Unfortunately, your account does not have such rights.
<br><br>If you believe you've reached this message in error, please notify the Web site administrator.",
    "Due to security settings, you are not able to edit this post. Most likely, another moderator has already approved the post you are attempting to edit. Administrators may edit any post. Moderators may only edit non-Approved posts in forums they have been selected to moderate.
<br><br>If you believe you've reached this message in error, please contact the Web site administrator.",
    "In order to participate in the moderation of posts, you must have been granted adequate permissions from the Web site administrator. That is, the Web site administrator must have explicitly setup your User account to allow for post moderation.<br><br>Please contact the Web site administrator if you believe you've reached this message in error.",
    "You have, in the past, attempted to post a question on this forum, or another forum, with the same body. Duplicate posts are not allowed. This rule is sort of irritating but it helps cut down on spam.",
    "The file you requested cannot be found.",
    "The forum you requested does not exist.",
    "You will soon receive an email which will contain a randomly generated password. Once you have this information you may login at the ROBLOX Forum Login.
Once you've logged in, you may wish to visit your user profile and change your password - all of these details will be provided in the email.",
    "Your post is breaking some ROBLOX rule. There is probably a word in your post that we do not allow either because it's too harsh for ROBLOX or it breaks our Privacy rules. We also don't allow talking about other online games.
<br><br>You should try your post again with different words. Putting dashes, periods, spaces or other breaks in a word to get around the filter is not allowed either. We block these words for a reason which may seem silly to you but these are our rules.",
    "The post you attempted to view does not exist. Most likely, the message you are trying to view has been deleted by one of the site's administrators.",
];
?>

<table width="100%">
	<tbody>
		<tr>
			<td align="center">
				<table cellspacing="1" cellpadding="0" width="50%" class="tableBorder">
					<tbody>
						<tr>
							<th align="left"> &nbsp; <span id="ctl00_cphRoblox_Message1_ctl00_MessageTitle" class="tableHeaderText">Error: <?=$error[$errorId]?></span>
							</th>
						</tr>
						<tr>
							<td class="forumRow">
								<table cellpadding="3" cellspacing="0">
									<tbody>
										<tr>
											<td> &nbsp; </td>
											<td>
												<span id="ctl00_cphRoblox_Message1_ctl00_MessageBody" class="normalTextSmall"><?=$errorDesc[$errorId]?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<br>
			</td>
		</tr>
	</tbody>
</table>

<?php
PageBuilder::addComponent("forum", "footer");
?>