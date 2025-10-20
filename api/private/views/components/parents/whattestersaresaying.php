<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<a name="top"></a>
		<div id="BreadcrumbsContainer">
			<a id="ctl00_cphRoblox_BreadcrumbsHyperLink" href="/Parents.aspx"><?=Site::getThemeProperty("alias", $theme)?> Parents</a> &gt; What Parents are Saying
		</div>
		<a id="ctl00_cphRoblox_PageImage" class="PageImage" onclick="javascript:__doPostBack('ctl00$cphRoblox$PageImage','')" style="display:inline-block;cursor:pointer;">
			<img src="/images/Parents/WhatParentsAreSaying-110x110.png" border="0" blankurl="http://t6.roblox.com:80/blank-256x256.gif">
		</a>
		<h2>What Players (old and new) are Saying</h2>
		<div class="Navigation">
			<ul>
				<li>
					<a href="#2024">Oldgens</a>
				</li>
				<li>
					<a href="#2025">Newgens</a>
				</li>
			</ul>
		</div>
		<div class="ContentSection">
			<p>We are in the process of collecting testimonials for this section. If you have feedback on <?=Site::getThemeProperty("alias", $theme)?>, please send your comments to <a href="#">the discord server</a>. The following are all 100% real testimonials: </p>
		</div>
		<h3>
			<a href="#2024">2024 Users</a>
		</h3>
		<blockquote>
			<p>
				<strong>Oldgen #1</strong>
				<br> "something this oldgen said"
			</p>
		</blockquote>
		<h3>
			<a href="#2025">2025 Users</a>
		</h3>
		<blockquote>
			<p>
				<strong>Newgen #1</strong>
				<br> "something this newgen said"
			</p>
		</blockquote>
	</div>
</div>