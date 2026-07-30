<?php
#made: 03/30/2025 @marsoc
#last edit: 03/30/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php");
$page->buildHeader();
?>

<div id="Body">
	<br>
	<br>
	<h2> Welcome to <?=Site::getThemeProperty("alias", $theme)?> Help</h2>
	<p style="font-size: large"> If you need help with <?=Site::getThemeProperty("alias", $theme)?>, then please visit one of our help forums below: <br>
	</p>
	<p>
		<img id="ctl00_cphRoblox_Image1" src="/images/help_bullet.png" border="0">
		<a id="ctl00_cphRoblox_HyperLink1" href="/Forum/ShowForum.aspx?ForumID=19">
			<font size="5">I need help with building</font>
		</a>
	</p>
	<p>
		<img id="ctl00_cphRoblox_Image2" src="/images/help_bullet.png" border="0">
		<a id="ctl00_cphRoblox_HyperLink2" href="/Forum/ShowForum.aspx?ForumID=20">
			<font size="5">I need help with scripting</font>
		</a>
	</p>
	<p>
		<img id="ctl00_cphRoblox_Image3" src="/images/help_bullet.png" border="0">
		<a id="ctl00_cphRoblox_HyperLink4" href="/Forum/ShowForum.aspx?ForumID=14">
			<font size="5">I need technical help</font>
		</a>
	</p>
	<p>
		<img id="ctl00_cphRoblox_Image4" src="/images/help_bullet.png" border="0">
		<a id="ctl00_cphRoblox_HyperLink3" href="/Forum/ShowForum.aspx?ForumID=21">
			<font size="5">I have a suggestion</font>
		</a>
	</p>
	<p style="font-size: large"> Did you find an answer? <input type="submit" name="ctl00$cphRoblox$Button1" value="Yes" id="ctl00_cphRoblox_Button1">
		<input type="submit" name="ctl00$cphRoblox$Button2" value="No" id="ctl00_cphRoblox_Button2">
	</p>
	<br>
	<br>
</div>