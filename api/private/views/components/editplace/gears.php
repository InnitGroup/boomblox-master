<?php
$genre = $place["genre"];
?>

<div id="PlaceCopyProtection">
	<div id="SetGenres">
		<fieldset>
			<legend>Genre</legend>
			<div class="Suggestion"> Classify your Place to help people find it. </div>
			<div id="ctl00_cphRoblox_AllowOneGenre">
				<div class="MyItemIndentedOption">
					<ul style="list-style: none;">
						<li>
							<img src="/images/GenreIcons/Classic.png" alt="All">
							<label>
								<input type="radio" name="GenreButtons2" value="0" <?=$genre == 0 ? 'checked="checked"' : ''?>> All </label>
						</li>
						<li>
							<img src="/images/GenreIcons/City.png" alt="Town and City">
							<label>
								<input type="radio" name="GenreButtons2" value="20" <?=$genre == 20 ? 'checked="checked"' : ''?>> Town and City </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Castle.png" alt="Fantasy">
							<label>
								<input type="radio" name="GenreButtons2" value="6" <?=$genre == 6 ? 'checked="checked"' : ''?>> Fantasy </label>
						</li>
						<li>
							<img src="/images/GenreIcons/SciFi.png" alt="Sci-Fi">
							<label>
								<input type="radio" name="GenreButtons2" value="16" <?=$genre == 16 ? 'checked="checked"' : ''?>> Sci-Fi </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Ninja.png" alt="Ninja">
							<label>
								<input type="radio" name="GenreButtons2" value="11" <?=$genre == 11 ? 'checked="checked"' : ''?>> Ninja </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Cthulu.png" alt="Scary">
							<label>
								<input type="radio" name="GenreButtons2" value="14" <?=$genre == 14 ? 'checked="checked"' : ''?>> Scary </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Pirate.png" alt="Pirate">
							<label>
								<input type="radio" name="GenreButtons2" value="12" <?=$genre == 12 ? 'checked="checked"' : ''?>> Pirate </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Adventure.png" alt="Adventure">
							<label>
								<input type="radio" name="GenreButtons2" value="1" <?=$genre == 1 ? 'checked="checked"' : ''?>> Adventure </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Sports.png" alt="Sports">
							<label>
								<input type="radio" name="GenreButtons2" value="18" <?=$genre == 18 ? 'checked="checked"' : ''?>> Sports </label>
						</li>
						<li>
							<img src="/images/GenreIcons/LOL.png" alt="Funny">
							<label>
								<input type="radio" name="GenreButtons2" value="8" <?=$genre == 8 ? 'checked="checked"' : ''?>> Funny </label>
						</li>
						<li>
							<img src="/images/GenreIcons/WildWest.png" alt="Wild West">
							<label>
								<input type="radio" name="GenreButtons2" value="22" <?=$genre == 22 ? 'checked="checked"' : ''?>> Wild West </label>
						</li>
						<li>
							<img src="/images/GenreIcons/ModernMilitary.png" alt="War">
							<label>
								<input type="radio" name="GenreButtons2" value="21" <?=$genre == 21 ? 'checked="checked"' : ''?>> War </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Skatepark.png" alt="Skate Park">
							<label>
								<input type="radio" name="GenreButtons2" value="17" <?=$genre == 17 ? 'checked="checked"' : ''?>> Skate Park </label>
						</li>
						<li>
							<img src="/images/GenreIcons/Tutorial.gif" alt="Tutorial">
							<label>
								<input type="radio" name="GenreButtons2" value="20" <?=$genre == 20 ? 'checked="checked"' : ''?>> Tutorial </label>
						</li>
					</ul>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div id="ctl00_cphRoblox_GearOptionsPanel">
	<div class="MyItemOptions">
		<fieldset>
			<legend>Gear Settings</legend>
			<?php
			$allCategoriesSet = Category::allCategoriesSet($place["itemId"]);
			?>
			<div id="ctl00_cphRoblox_PlaceGearOptions">
				<div class="Suggestion"> Here you can choose whether to allow all genres of gear into your place, or whether to only allow gear that matches your place's genre. </div>
				<div class="MyItemIndentedOption">
					<img id="ctl00_cphRoblox_Image17" src="../images/Suitcase16x16.png" alt="Allow All" style="border-width:0px;">
					<input id="ctl00_cphRoblox_rbAllowAllGenres" type="radio" name="ctl00$cphRoblox$GearGenreButtons" value="rbAllowAllGenres" <?=$allCategoriesSet == true ? 'checked="checked"' : ""?>>
					<label for="ctl00_cphRoblox_rbAllowAllGenres">All genres</label>
					<br>
					<img id="ctl00_cphRoblox_Image16" src="../images/GenreSuitcase16x16.png" alt="Genre Specific Only" style="border-width:0px;">
					<input id="ctl00_cphRoblox_rbAllowSpecificGenres" type="radio" name="ctl00$cphRoblox$GearGenreButtons" value="rbAllowSpecificGenres" <?=$allCategoriesSet == true ? "" : 'checked="checked"'?>>
					<label for="ctl00_cphRoblox_rbAllowSpecificGenres">Only genres that match my place</label>
					<br>
				</div>
			</div>
            <?php 
            $categories = Category::getCategories($place["itemId"]);
            ?>
			<div id="ctl00_cphRoblox_GearTypesPanel">
				<div class="Suggestion"> Check all the Gear types you wish to allow in your place. </div>
				<div class="MyItemIndentedOption">
					<img id="ctl00_cphRoblox_Image1" src="../images/CategoryIcons/Melee.png" alt="Melee" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbMelee" type="checkbox" name="ctl00$cphRoblox$cbMelee" <?=in_array(3, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbMelee">Melee Weapons</label>
					<br>
					<img id="ctl00_cphRoblox_Image2" src="../images/CategoryIcons/Ranged.png" alt="Ranged" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbRanged" type="checkbox" name="ctl00$cphRoblox$cbRanged" <?=in_array(7, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbRanged">Ranged Weapons</label>
					<br>
					<img id="ctl00_cphRoblox_Image3" src="../images/CategoryIcons/Explosive.png" alt="Explosive" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbExplosives" type="checkbox" name="ctl00$cphRoblox$cbExplosives" <?=in_array(1, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbExplosives">Explosives</label>
					<br>
					<img id="ctl00_cphRoblox_Image4" src="../images/CategoryIcons/PowerUps.png" alt="Power Ups" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbPowerups" type="checkbox" name="ctl00$cphRoblox$cbPowerups" <?=in_array(6, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbPowerups">Power Ups</label>
					<br>
					<img id="ctl00_cphRoblox_Image5" src="../images/CategoryIcons/Navigation.png" alt="Navigation" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbNavigation" type="checkbox" name="ctl00$cphRoblox$cbNavigation" <?=in_array(5, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbNavigation">Navigation Enhancers</label>
					<br>
					<img id="ctl00_cphRoblox_Image6" src="../images/CategoryIcons/Music.png" alt="Music" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbInstruments" type="checkbox" name="ctl00$cphRoblox$cbInstruments" <?=in_array(4, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbInstruments">Musical Instruments</label>
					<br>
					<img id="ctl00_cphRoblox_Image7" src="../images/CategoryIcons/Social.png" alt="Social" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbSocial" type="checkbox" name="ctl00$cphRoblox$cbSocial" <?=in_array(8, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbSocial">Social Items</label>
					<br>
					<img id="ctl00_cphRoblox_Image34" src="../images/CategoryIcons/Building.png" alt="Building" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbBuilding" type="checkbox" name="ctl00$cphRoblox$cbBuilding" <?=in_array(0, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbBuilding">Building Tools</label>
					<br>
					<img id="ctl00_cphRoblox_Image8" src="../images/CategoryIcons/PersonalTransport.png" alt="Personal Transportation Items" style="border-width:0px;">
					<input id="ctl00_cphRoblox_cbPersonalTransport" type="checkbox" name="ctl00$cphRoblox$cbPersonalTransport" <?=in_array(9, $categories) ? 'checked="checked"' : ''?>>
					<label for="ctl00_cphRoblox_cbPersonalTransport">Personal Transport</label>
					<br>
				</div>
			</div>
		</fieldset>
	</div>
</div>