<?php
global $theme;
?>

<div class="FrontPagePanel" id="RandomFacts">
		<div id="ctl00_cphRoblox_RandomFacts_pRandomFacts">
			<h3 style="text-align: center;"><?=Site::getThemeProperty("alias", $theme)?> Facts</h3>
			<div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed">
				<div id="vmarquee" style="position: absolute; top: -70px;">
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
				</div>
			</div>
		</div>
	</div>