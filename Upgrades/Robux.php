<?php
#made: 03/30/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new PageBuilder(Site::getThemeProperty("alias", $theme)." - Buy ".Site::getThemeProperty("currency", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();
?>

<div id="Body">
	<div id="RobloxCentralBank">
		<img id="ctl00_cphRoblox_HeaderImage" src="/images/RobloxCentralBank.png" alt="Roblox Central Bank" border="0">
	</div>
	<div class="StandardBox">
		<div id="ctl00_cphRoblox_BuildersClubContainer" class="BuyRobuxOptions">
			<p style="text-align: center; font-size: large;">Click a link below to choose the quantity of <?=Site::getThemeProperty("currency", $theme)?> you wish to purchase.</p>
			<p style="text-align: center; color: Red;">NOTE: Please allow up to 5 minutes for your account to be credited.</p>
			<div id="OptionsMatrix" style="margin: 10px 0;">
				<table cellpadding="7" style="margin: 0 auto;">
					<tbody>
						<tr>
							<td align="center">
								<strong>Price</strong>
							</td>
							<td align="center">
								<strong>Standard Members</strong>
							</td>
							<td align="center">
								<strong><?=Site::getThemeProperty("membership", $theme)?> Members</strong>
							</td>
						</tr>
						<tr>
							<td align="center">$4.95 USD</td>
							<td align="center"> Not Available </td>
							<td align="center"> 450 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
						<tr>
							<td align="center">$9.95 USD</td>
							<td align="center"> Not Available </td>
							<td align="center"> 1,000 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
						<tr>
							<td align="center">$24.95 USD</td>
							<td align="center">
								<a id="ctl00_cphRoblox_Tier3StandardHyperLink" href="PaymentMethods.aspx?ap=7">2,000 <?=Site::getThemeProperty("currency", $theme)?></a>
							</td>
							<td align="center"> 2,750 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
						<tr>
							<td align="center">$49.95 USD</td>
							<td align="center">
								<a id="ctl00_cphRoblox_Tier4StandardHyperLink" href="PaymentMethods.aspx?ap=8">4,500 <?=Site::getThemeProperty("currency", $theme)?></a>
							</td>
							<td align="center"> 6,000 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
						<tr>
							<td align="center">$99.95 USD</td>
							<td align="center">
								<a id="ctl00_cphRoblox_Tier5StandardHyperLink" href="PaymentMethods.aspx?ap=10">10,000 <?=Site::getThemeProperty("currency", $theme)?></a>
							</td>
							<td align="center"> 15,000 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
						<tr>
							<td align="center">$199.95 USD</td>
							<td align="center">
								<a id="ctl00_cphRoblox_Tier6StandardHyperLink" href="PaymentMethods.aspx?ap=17">22,500 <?=Site::getThemeProperty("currency", $theme)?></a>
							</td>
							<td align="center"> 35,000 <?=Site::getThemeProperty("currency", $theme)?> </td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="ctl00_cphRoblox_rbxGetBCPane_GetBCPanel" class="RightColumnBox">
			<a href="BuildersClub.aspx" style="text-decoration:none; cursor: pointer">
				<img style="float:left; vertical-align:top; border: none;" src="/images/HardHatBullet.png" width="32px" height="32px">
				<h1><?=Site::getThemeProperty("membership", $theme)?>!</h1>
			</a>
			<p style="clear: left"> <?=Site::getThemeProperty("alias", $theme)?> is free to play, but you can upgrade your account for greater enjoyment. Take a look at all the fabulous benefits your receive when you join <a href="BuildersClub.aspx"><?=Site::getThemeProperty("membership", $theme)?></a>! </p>
		</div>
	</div>
	<br clear="all">
</div>

<?php
$page->buildFooter();
?>