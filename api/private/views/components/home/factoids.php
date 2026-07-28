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
						<?=Factoids::generateCatalogFactoid("pants")?>
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Bux.png"> 100 <?=Site::getThemeProperty("currency", $theme)?> buys about <b>1000</b> tickets on the <a href="Marketplace/TradeCurrency.aspx">Currency Exchange</a> right now
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Shirt.png">
						<?=Factoids::generateCatalogFactoid("shirt")?>
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/ShoppingBag.png"> the average bid for a user-run <b>rectangle</b> ad is <b>212</b> tickets
					</div>
					<div class="RandomFactoid">
						<img src="/images/RandomFactsIcons/Shield.png"> there are <b>0</b>
						<a href="Parents.aspx">parents</a> keeping track of their kids on <?=Site::getThemeProperty("alias", $theme)?>
					</div>
					<div class="RandomFactoid">
						<?php
						global $db;
						$stmt = "SELECT id FROM users WHERE `level` > 2";
						$admins = $db->execute($stmt);
						$count = 0;
						while ($admin = $admins->fetch(PDO::FETCH_ASSOC)) {
							$adminU = new User($admin["id"]);
							if ($adminU->isOnline()) $count++;
						}
						?>
						<img src="/images/RandomFactsIcons/Admin.png">
						<b><?=$count?></b> forum moderator<?=$count == 0 || $count > 1 ? "s are" : " is"?> providing help in the forums
					</div>
				</div>
			</div>
		</div>
	</div>