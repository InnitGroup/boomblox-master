<?php
PageBuilder::addComponent("forum", "header");
PageBuilder::addComponent("forum", "navmenu");

global $db;

$stmt = "SELECT * FROM users LIMIT 50";
$result = $db->execute($stmt);
$users = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<p>
	<span id="ctl00_cphRoblox_Showallusers1" name="Showallusers1"></span>
</p>
<table cellpadding="0" width="100%">
	<tbody>
		<tr>
			<td align="left" valign="top">
				<span class="forumName">Member List</span>
			</td>
		</tr>
		<tr>
			<td align="center">
				<span id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker">
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_A" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_A','')">A</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_B" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_B','')">B</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_C" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_C','')">C</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_D" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_D','')">D</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_E" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_E','')">E</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_F" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_F','')">F</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_G" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_G','')">G</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_H" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_H','')">H</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_I" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_I','')">I</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_J" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_J','')">J</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_K" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_K','')">K</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_L" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_L','')">L</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_M" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_M','')">M</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_N" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_N','')">N</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_O" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_O','')">O</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_P" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_P','')">P</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_Q" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_Q','')">Q</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_R" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_R','')">R</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_S" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_S','')">S</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_T" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_T','')">T</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_U" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_U','')">U</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_V" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_V','')">V</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_W" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_W','')">W</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_X" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_X','')">X</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_Y" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_Y','')">Y</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_Z" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_Z','')">Z</a>
					<span class="normalTextSmallBold"> | </span>
					<a id="ctl00_cphRoblox_Showallusers1_ctl00_AlphaPicker_LetteredLink_All" class="linkSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$AlphaPicker$LetteredLink_All','')">All</a>
				</span>
			</td>
			<td valign="bottom" align="right"> &nbsp; <span class="normalTextSmall">Sort by: </span>
				<select name="ctl00$cphRoblox$Showallusers1$ctl00$SortBy" id="ctl00_cphRoblox_Showallusers1_ctl00_SortBy">
					<option selected="selected" value="0">Date Joined</option>
					<option value="3">Date Last Active</option>
					<option value="4">Posts</option>
					<option value="1">Username</option>
					<option value="2">Website</option>
				</select> &nbsp; <span class="normalTextSmall">Order: </span>
				<select name="ctl00$cphRoblox$Showallusers1$ctl00$SortDirection" id="ctl00_cphRoblox_Showallusers1_ctl00_SortDirection">
					<option selected="selected" value="0">Ascending</option>
					<option value="1">Descending</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right" colspan="2">
				<table id="ctl00_cphRoblox_Showallusers1_ctl00_UserList" class="tableBorder" cellspacing="1" cellpadding="3" border="0" width="100%">
					<tbody>
						<tr>
							<th class="tableHeaderText" align="left">&nbsp;#&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Username&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Website&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Location&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Joined&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Last Active&nbsp;</th>
							<th class="tableHeaderText" align="left">&nbsp;Posts&nbsp;</th>
						</tr>
                        <?php
                        foreach ($users as $f_user):
                            $joined = new DateTime($f_user["reg_date"]);
                            $joined = $joined->format("d M Y");
                            $lastActive = new DateTime($f_user["lastOnline"]);
                            $lastActive = $lastActive->format("d M Y");
                        ?>
						<tr>
							<td class="forumRow" align="center" valign="middle" width="25">
								<span class="normalTextSmallBold"><?=$f_user["id"]?></span>
							</td>
							<td class="forumRow">
								<a class="linkSmallBold" href="/Forum/User/UserProfile.aspx?UserName=<?=htmlspecialchars($f_user["id"])?>"><?=htmlspecialchars($f_user["username"])?></a>
							</td>
							<td class="forumRowHighlight" align="left">
								<a class="linkSmallBold" target="_blank">-</a>
							</td>
							<td class="forumRowHighlight" align="left">
								<span class="normalTextSmall"></span>
							</td>
							<td class="forumRowHighlight" align="left">
								<span class="normalTextSmall"><?=$joined?></span>
							</td>
							<td class="forumRowHighlight" align="left">
								<span class="normalTextSmall"><?=$lastActive?></span>
							</td>
							<td class="forumRowHighlight" align="left">
								<a class="linkSmallBold" href="/Forum/Search/default.aspx?SearchFor=1&amp;SearchText=<?=$f_user["id"]?>"><?=$f_user["forumPosts"]?></a>
							</td>
						</tr>
                        <?php endforeach; ?>
						<tr>
							<td class="forumHeaderBackgroundAlternate" colspan="8"></td>
						</tr>
					</tbody>
				</table>
				<span id="ctl00_cphRoblox_Showallusers1_ctl00_Pager">
					<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tbody>
							<tr>
								<td>
									<span class="normalTextSmallBold">Page 1 of 9,542</span>
								</td>
								<td align="right">
									<span>
										<span class="normalTextSmallBold">Goto to page: </span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Page0" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Page0','')">1</a>
										<span class="normalTextSmallBold">, </span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Page1" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Page1','')">2</a>
										<span class="normalTextSmallBold">, </span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Page2" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Page2','')">3</a>
										<span class="normalTextSmallBold"> ... </span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Page9540" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Page9540','')">9,541</a>
										<span class="normalTextSmallBold">, </span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Page9541" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Page9541','')">9,542</a>
										<span class="normalTextSmallBold">&nbsp;</span>
										<a id="ctl00_cphRoblox_Showallusers1_ctl00_Pager_Next" class="normalTextSmallBold" href="javascript:__doPostBack('ctl00$cphRoblox$Showallusers1$ctl00$Pager$Next','')">Next</a>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</span>
			</td>
		</tr>
		<tr>
			<td> &nbsp; </td>
		</tr>
		<tr>
			<td colspan="2" align="right"> &nbsp; <span class="normalTextSmall">Find User: </span>
				<input name="ctl00$cphRoblox$Showallusers1$ctl00$SeachForUser" type="text" id="ctl00_cphRoblox_Showallusers1_ctl00_SeachForUser">
				<input type="submit" name="ctl00$cphRoblox$Showallusers1$ctl00$SearchButton" value=" Search " id="ctl00_cphRoblox_Showallusers1_ctl00_SearchButton">
			</td>
		</tr>
	</tbody>
</table>

<?php
PageBuilder::addComponent("forum", "footer");
?>