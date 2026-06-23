<div id="ctl00_cphRoblox_GearOptionsPanel">
	<div class="MyItemOptions">
		<fieldset>
			<legend>Gear Settings</legend>
			<div id="ctl00_cphRoblox_PlaceGearOptions">
				<div class="Suggestion"> Here you can choose whether to allow all genres of gear into your place, or whether to only allow gear that matches your place's genre. </div>
				<div class="MyItemIndentedOption">
					<img id="ctl00_cphRoblox_Image17" src="../images/Suitcase16x16.png" alt="Allow All" style="border-width:0px;">
					<input id="ctl00_cphRoblox_rbAllowAllGenres" type="radio" name="ctl00$cphRoblox$GearGenreButtons" value="rbAllowAllGenres" checked="checked">
					<label for="ctl00_cphRoblox_rbAllowAllGenres">All genres</label>
					<br>
					<img id="ctl00_cphRoblox_Image16" src="../images/GenreSuitcase16x16.png" alt="Genre Specific Only" style="border-width:0px;">
					<input id="ctl00_cphRoblox_rbAllowSpecificGenres" type="radio" name="ctl00$cphRoblox$GearGenreButtons" value="rbAllowSpecificGenres">
					<label for="ctl00_cphRoblox_rbAllowSpecificGenres">Only genres that match my place</label>
					<br>
				</div>
			</div>
            <?php 
            $categories = Category::getCategories($place["itemId"]);
            #print_r($_POST);
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