<div id="MainPanel">
	<div>
		<p>
			<input type="text" name="ctl00$cphRoblox$gvShoutboxInput" id="ctl00$cphRoblox$gvShoutboxInput"> &nbsp; <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$gvShoutbox','Post')" id="ctl00_cphRoblox_OverrideAccountStateButton">Post</a>
		</p>
		<table class="ShoutboxTable">
			<tbody>
				<tr style="background-color: #FACA9B;">
					<th style="background-color: #FACA9B;">User</th>
					<th style="background-color: #FACA9B;">Text</th>
					<th style="background-color: #FACA9B;">Post Date</th>
				</tr>
				<?php
                if (!empty($shouts)) {
                    foreach ($shouts as $shout) {
                        $packed = compact("shout");
                        PageBuilder::addComponent("shoutbox", "shout", $packed);
                    }
                } else {
                    PageBuilder::addComponent("shoutbox", "none");
                }
                ?>
			</tbody>
		</table>
	</div>
</div>