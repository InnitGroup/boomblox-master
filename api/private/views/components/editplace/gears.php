<div id="PlaceCopyProtection">
    <fieldset title="Gear Settings">
        <legend>Gear Settings</legend>
        <div class="Suggestion"> Here you can choose whether or not to allow gear into your place. </div>
        <div class="CopyProtectionRow">
            <input type="checkbox" <?=$place["gears"] !== NULL ? 'checked' : ''?> name="ctl00$cphRoblox$cbHasGears">
            <label for="ctl00_cphRoblox_cbHasGears">Allow gears in my place</label>
        </div>
    </fieldset>
</div>