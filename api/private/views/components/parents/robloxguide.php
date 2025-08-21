<?php
global $theme;
?>

<div id="Body">
	<div class="ParentsContainer">
		<a name="top"></a>
		<div id="BreadcrumbsContainer">
			<a id="ctl00_cphRoblox_BreadcrumbsHyperLink" href="/Parents.aspx"><?=Site::getThemeProperty("alias", $theme)?> Parents</a> &gt; <?=Site::getThemeProperty("alias", $theme)?> Guide
		</div>
		<a id="ctl00_cphRoblox_PageImage" class="PageImage" onclick="javascript:__doPostBack('ctl00$cphRoblox$PageImage','')" style="display:inline-block;cursor:pointer;">
			<img src="/images/Parents/RobloxGuide-110x115.png" border="0" blankurl="http://t0.roblox.com:80/blank-283x294.gif">
		</a>
		<h2><?=Site::getThemeProperty("alias", $theme)?> Guide</h2>
		<div class="Navigation">
			<ul>
				<li>
					<a href="#WhatIsRoblox">What is <?=Site::getThemeProperty("alias", $theme)?>?</a>
				</li>
				<li>
					<a href="#WhatCanYouDo">What can you do in <?=Site::getThemeProperty("alias", $theme)?>?</a>
				</li>
				<li>
					<a href="#WhyDidWeCreate">Why did we create <?=Site::getThemeProperty("alias", $theme)?>?</a>
				</li>
				<li>
					<a href="#FreeToJoin"><?=Site::getThemeProperty("alias", $theme)?> is free to join</a>
				</li>
				<li>
					<a href="#GamesAndPoints">Games and points</a>
				</li>
				<li>
					<a href="#ThankYou">Thank you</a>
				</li>
			</ul>
		</div>
		<div class="ContentSection">
			<p>Welcome to <?=Site::getThemeProperty("alias", $theme)?>, an online virtual playground and workshop where kids of all ages can safely interact, create, have fun and learn.</p>
		</div>
		<dl>
			<dt>
				<a name="WhatIsRoblox">What is <?=Site::getThemeProperty("alias", $theme)?>?</a>
			</dt>
			<dd>
				<p><?=Site::getThemeProperty("alias", $theme)?> is unique among kid-targeted sites in that everything in the world is designed and constructed by individual members of the <?=Site::getThemeProperty("alias", $theme)?> community. Every member is granted a place along with an infinite supply of <?=Site::getThemeProperty("alias", $theme)?> building pieces. Members design and build anything imagined — be it a navigable skyscraper, a working helicopter, a giant pinball machine, a multiplayer "Capture the Flag" game or some other, yet-to-be-dreamed-up object or activity.</p>
			</dd>
			<dt>
				<a name="WhatCanYouDo">What can you do in <?=Site::getThemeProperty("alias", $theme)?>?</a>
			</dt>
			<dd>
				<p><?=Site::getThemeProperty("alias", $theme)?> members can choose to play and create alone or, with the help of personal and customizable avatars, they can choose to be social and engage with others. Members can explore the world with their avatars, meet and communicate with other members, visit other member-created environments, and collaborate with others on projects.</p>
				<p>There are no pre-defined goals in <?=Site::getThemeProperty("alias", $theme)?>. The focus is largely on creative and open-ended play. However, there are numerous member-created and very popular games — both solo and multiplayer — from head-to-head bobsledding to multiplayer paintball.</p>
			</dd>
			<dt>
				<a name="WhyDidWeCreate">Why did we create <?=Site::getThemeProperty("alias", $theme)?>?</a>
			</dt>
			<dd>
				<p>We are passionate about creating meaningful experiences that ignite the imagination and engage the mind.</p>
				<p>There are many online sites for kids. However, most of these sites are focused primarily on helping kids socialize and play games. We wanted to build something more — a place that not only satisfies kids' social and entertainment needs but that also satisfies kids' hunger for creativity and learning.</p>
			</dd>
			<dt>
				<a name="FreeToJoin"><?=Site::getThemeProperty("alias", $theme)?> is free to join</a>
			</dt>
			<dd>
				<p>Standard membership in <?=Site::getThemeProperty("alias", $theme)?> is free. This option entitles kids to sign-up for <?=Site::getThemeProperty("alias", $theme)?> on their own and to participate on a limited basis. Account members are given an avatar and the ability to design, build, and save only a single place.</p>
			</dd>
			<dt>
				<a name="GamesAndPoints">Games and points</a>
			</dt>
			<dd>
				<p>Members are recognized and earn rewards for their level of participation, the quality and popularity of their creations, and for their community spirit. Rewards range from specialty badges, to site-wide promotion of member-created content, to actual <?=Site::getThemeProperty("alias", $theme)?> currency ("<?=Site::getThemeProperty("currency", $theme)?>") that can be redeemed in the <?=Site::getThemeProperty("alias", $theme)?> catalog for avatar accessories and premium construction materials.</p>
			</dd>
			<dt>
				<a name="ThankYou">Thank you</a>
			</dt>
			<dd>
				<p>Please don't hesitate to <a href="mailto:info@roblox.com">contact us</a> if you have any questions or comments. </p>
				<p>Happy building!</p>
				<p>The <?=Site::getThemeProperty("alias", $theme)?> Team</p>
			</dd>
		</dl>
	</div>
</div>