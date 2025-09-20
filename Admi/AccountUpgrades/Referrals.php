<?php
#made: 04/21/2025 @marsoc
#last edit: 04/21/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;
$page->buildHeader();
?>
<div id="MainPanel">
	<div style="background-color:white;padding:8px;border-style:solid;border-color:#7EA7D3;border-width:2px;">
		<div style="background-color: #D1E3F8;padding-left:10px;padding-bottom:5px;margin-right:10px;">
			<br>
			<p>BC Referrals Enabled</p>
			<p>
				<input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Change Enabled Status" id="ctl00_cphRoblox_OverrideAccountStateButton">
			</p>
			<a>Current Award Description:</a>
			<br>
			<textarea id="w3review" name="w3review" rows="10" cols="64"></textarea>
			<p>
				<input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Change Description" id="ctl00_cphRoblox_OverrideAccountStateButton">
			</p>
			<p>ROBUX: <input type="text">
			</p>
			<p>
				<input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Change Referral Bonus ROBUX" id="ctl00_cphRoblox_OverrideAccountStateButton">
			</p>
		</div>
        <table style="width:100%">
				<tbody>
					<tr style="text-align:left;">
						<th style="background-color: white; color: #7EA7D3; width:40%;">Username</th>
						<th style="background-color: white; color: #7EA7D3; width:40%;">Number of Referrals</th>
						<th style="background-color: white; color: #7EA7D3; width:20%;">Last Referral</th>
					</tr>
                    <tr>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                    </tr>
					<tr style="background-color: #F4F4F4;">
						<td>
							<a href="#">ROBLOX</a>
						</td>
						<td>10000</td>
						<td>4/20/2025</td>
					</tr>
					<tr style="background-color: white;">
						<td>
							<a href="#">george0001</a>
						</td>
						<td>10</td>
						<td>4/20/2025</td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
<?php
$page->buildFooter();
?>