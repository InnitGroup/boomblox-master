<?php
$friends = $user->getFriends(false);
?>

<div id="Body">
	<div id="FriendsContainer">
		<div id="Friends">
			<h4>My Friends (<?=count($friends)?>)</h4>
			<div id="ctl00_cphRoblox_rbxEditFriendsPane_Pager1_PanelPages" style="text-align:center;"> Pages: </div>
			<table id="ctl00_cphRoblox_rbxEditFriendsPane_dlFriends" cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
				<tbody>
					<tr>
                    <?php
                        foreach ($friends as $key => $friend) {
                            if (($key % 6) == 0) {
                                echo "</tr>";
                            }
                            PageBuilder::addComponent("editfriends", "friend", compact("friend", "key"));
                        }
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>