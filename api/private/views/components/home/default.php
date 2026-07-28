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
	<iframe width="424" height="250" src="<?=$theme == 1 ? "https://www.youtube.com/embed/OBUlpvyInzg?si=zpjI-o6oUUv04rB4" : "https://www.youtube.com/embed/ipeQVDlcNjg?si=VW1xERt_5n7DzWpU"?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
	</div>
	<div class="FrontPagePanel" id="FrontPageRectangleAd">
		<?=Ad::generateAd("300x250a")?>
	</div>
	<div class="FrontPagePanel" id="SalesPitch">
		<a id="ctl00_cphRoblox_MoneyMachine_PlayNowButton" href="/Upgrades/ROBUX.aspx">
			<img src="/images/SalesPitcher/ExtraCash<?=$theme == 1 ? "" : "Boomblox"?>.png" border="0">
		</a>
	</div>
	<?=PageBuilder::addComponent("home", "factoids")?>
	<div class="FrontPagePanel" id="WhatsNew">
		<div>
			<?php
				$featuredGameId = 502;
				$featuredGame = new Item($featuredGameId);
				$game = $featuredGame->get();
				$asset = new Asset($featuredGameId);
				$assetRender = $asset->GetThumbnail(420, 230, "PNG");
				$creatorId = $game->creatorId;
				$creator = new User($creatorId);
				$avatar = new Avatar($creatorId);
				$avatarRender = $avatar->GetThumbnail(500, 500, "PNG");
			?>
			<div style="text-align: center;">
				<h3>Featured Free Game: <span id="ctl00_cphRoblox_FeaturedGames_GameName"><?=mb_strimwidth(htmlspecialchars(Helper::debugString($game->itemName)), 0, 34)?></span>
				</h3>
			</div>
			<div style="float: left;">
				<div style="margin: 0px 5px 5px 5px; ">
					<a id="ctl00_cphRoblox_FeaturedGames_AssetThumbnailImage" disabled="disabled" title="<?=htmlspecialchars(Helper::debugString($game->itemName))?>" href="/Item.aspx?ID=<?=$featuredGameId?>" style="display:inline-block;">
						<img src="<?=$assetRender?>" border="0" alt="<?=htmlspecialchars(Helper::debugString($game->itemName))?>">
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
							<a id="ctl00_cphRoblox_FeaturedGames_AvatarImage" title="<?=htmlspecialchars($creator->getUsername())?>" href="https://<?=domain?>/User.aspx?ID=<?=$creator->getUserId()?>" style="display:inline-block;cursor:pointer;">
								<img src="<?=$avatarRender?>" style="height:100px;" border="0" alt="<?=htmlspecialchars($creator->getUsername())?>" blankurl="http://t6-cf.roblox.com/blank-100x100.gif">
							</a>
						</div> Creator: <a id="ctl00_cphRoblox_FeaturedGames_CreatorHyperLink" href="User.aspx?ID=<?=$creator->getUserId()?>"><?=htmlspecialchars($creator->getUsername())?></a>
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