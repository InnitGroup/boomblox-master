<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;
$page->buildHeader();
?>

<div id="MainPanel">
	<div>
		<!-- basically what i think this page does is moderation for the thumbnails of games on the platform or ads something like that idk - george0001 -->
		<p>Thumbnail Request Count: 2</p>
		<p>Total Count: 0</p>
		<p>Thumbnail Blacklist Count: 0</p>
		<br>
		<p>
			<a>Failure Rate: NaN%</a>
			<a>Timeout Rate: NaN%</a>
		</p>
		<input type="submit" name="ctl00$cphRoblox$OverrideAccountStateButton" value="Clear Blacklist" id="ctl00_cphRoblox_OverrideAccountStateButton">
	</div>
</div>

<?php
$page->buildFooter();
?>