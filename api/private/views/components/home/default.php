<div id="Body">
	<div class="FrontPagePanel" id="SignInPane">
		<div id="LoginViewContainer">
			<div id="LoginView">
				<h5 id="loginViewTitle">Logged in</h5>
				<div id="AlreadySignedIn"></div>
				<?php 
				global $user, $theme;
				$avatar = new Avatar($user->getUserId());
				?>
				<a title="<?=$user->getUsername()?>" style="display:inline-block;height:190px;width:152px;cursor:pointer;" href="/User.aspx">
					<img src="<?=$avatar->GetThumbnail(540, 660, "PNG")?>" style="display:inline-block;height:175px;width:145px;margin-top:15px;" border="0" alt="<?=$user->getUsername()?>">
				</a>
			</div>
		</div>
	</div>
	<div class="FrontPagePanel" id="Movie">
	<iframe width="424" height="250" src="https://www.bitview.net/embed.php?v=LYkKRQuT7_5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
	</div>
	<div class="FrontPagePanel" id="FrontPageRectangleAd">
		<?=Ad::generateAd("300x250a")?>
	</div>
	<div class="FrontPagePanel" id="SalesPitch">
		<a id="ctl00_cphRoblox_MoneyMachine_PlayNowButton" href="/Upgrades/ROBUX.aspx">
			<img src="/images/SalesPitcher/ExtraCash.png" border="0">
		</a>
	</div>
	<div class="FrontPagePanel" id="RandomFacts">
		<div id="ctl00_cphRoblox_RandomFacts_pRandomFacts">
			<h3 style="text-align: center;"><?=Site::getThemeProperty("alias", $theme)?> Facts</h3>
			<div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed">
				<div id="vmarquee" style="position: absolute; top: -70px;">
					<!--YOUR SCROLL CONTENT HERE-->
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/House.png">
						<a href="Item.aspx?ID=1">
							<b>Sword Fights on the Heights IV </b>
						</a> has been favorited a lot recently
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Pants.png">
						<b>0</b>
						<a href="Catalog.aspx?m=BestSelling&amp;c=12&amp;t=PastWeek&amp;d=All&amp;q=tuxedo">fine-looking <b>tuxedos</b>
						</a> are available in the pants section of the catalog
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Bux.png"> 100 <?=Site::getThemeProperty("currency", $theme)?> buys about <b>400</b> tickets on the <a href="Marketplace/TradeCurrency.aspx">Currency Exchange</a> right now
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Shirt.png">
						<b>0</b>
						<a href="Catalog.aspx?m=BestSelling&amp;c=11&amp;t=PastWeek&amp;d=All&amp;q=assassin">deadly <b>assassin</b> robes </a> are available in the shirts section of the catalog
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/ShoppingBag.png"> the average bid for a user-run <b>rectangle</b> ad is <b>212</b> tickets
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Shield.png"> there are <b>0</b>
						<a href="Parents.aspx">parents</a> keeping track of their kids on <?=Site::getThemeProperty("alias", $theme)?>
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Admin.png">
						<b>0</b> forum moderators are providing help in the forums
					</div>
					<!--YOUR SCROLL CONTENT HERE-->
				</div>
			</div>
		</div>
	</div>
	<div class="FrontPagePanel" id="WhatsNew">
		<div>
			<div style="text-align: center;">
				<h3>Featured Game: <span id="ctl00_cphRoblox_FeaturedGames_GameName">gone fhishing {{WIP}}</span>
				</h3>
			</div>
			<?php
				$featuredGameId = 2586;
				$featuredGame = new Item($featuredGameId);
			?>
			<div style="float: left;">
				<div style="margin: 0px 5px 5px 5px; ">
					<a id="ctl00_cphRoblox_FeaturedGames_AssetThumbnailImage" disabled="disabled" title="gone fhishing {{WIP}}" href="/Item.aspx?ID=<?=$featuredGameId?>" style="display:inline-block;">
						<img src="https://t2.<?=domain?>/0055527c05201d325922f9dd82393972?v=1" border="0" alt="gone fhishing {{WIP}}">
					</a>
				</div>
			</div>
			<div style="float: right;">
				<div style="margin: 0px 5px 5px 2px; text-align: center;">
					<a id="ctl00_cphRoblox_FeaturedGames_PlayThis" href="Item.aspx?ID=<?=$featuredGameId?>">
						<img src="/images/PlayThis.png" border="0">
					</a>
					<div id="LastUpdate">Updated: <?=Helper::timeAgo($featuredGame->get()->lastUpdate)?></div>
					<div id="Favorited">Favorited: <?=Helper::times($featuredGame->get()->favorites)?></div>
					<div id="ctl00_cphRoblox_FeaturedGames_VisitedPanel" class="Visited">Visited: <?=Helper::times($featuredGame->get()->interactions)?></div>
					<div id="Creator" class="Creator">
						<div class="Avatar">
							<a id="ctl00_cphRoblox_FeaturedGames_AvatarImage" title="hecka" href="https://<?=domain?>/User.aspx?ID=140" style="display:inline-block;cursor:pointer;">
								<img src="https://t2.<?=domain?>/546fb3cf43677604674b9ad622b0a44c?v=1" style="height:100px;" border="0" alt="hecka" blankurl="http://t6-cf.roblox.com/blank-100x100.gif">
							</a>
						</div> Creator: <a id="ctl00_cphRoblox_FeaturedGames_CreatorHyperLink" href="User.aspx?ID=140">hecka</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="FrontPagePanel" id="ParentsCorner">
		<div id="Inside">
			<img id="ctl00_cphRoblox_ShieldImg" class="ShieldImage" src="/images/SuperSafe32.png" border="0">
			<div style="float:left; font-size: x-large; height: 42px; width: 220px; text-align: center;">Parents' Corner</div>
			<div style="clear: left;"></div>
			<p><?=Site::getThemeProperty("alias", $theme)?> is a kid-friendly place on the internet where your children can exercise their creativity in a safe, moderated online environment</p>
			<a id="ctl00_cphRoblox_LearnMore" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$LearnMore','')">Learn More</a>
			<a id="ctl00_cphRoblox_AccessParentAccount" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$AccessParentAccount','')">Access Parent Account</a>
			<a id="ctl00_cphRoblox_PrivacyPolicy" href="info/Privacy.aspx">
				<div style="width: 120px; float: left; padding: 5px; font-size: medium;">Privacy Policy</div>
			</a>
			<a id="ctl00_cphRoblox_TrusteeSeal" class="TrusteeSeal" href="#">
				<img src="/images/truste_seal_kids.gif" border="0">
			</a>
		</div>
	</div>
	<div class="FrontPagePanel" id="FrontPageBannerAd">
		<?=Ad::generateAd("728x90a")?>
	</div>
	<div class="FrontPagePanel" id="NewsFeeder">
		<?=PageBuilder::addComponent("home", "news")?>
	</div>
</div>