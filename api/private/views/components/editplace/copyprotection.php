<div id="PlaceCopyProtection">
    <fieldset title="Copy Protection">
        <legend>Copy Protection</legend>
        <div class="Suggestion"> Checking this will prevent your place from being copied but will also make it available to others only in online mode. </div>
        <div class="CopyProtectionRow">
            <input type="checkbox" <?=$place["onsale"] == 0 ? 'checked' : ''?> name="ctl00$cphRoblox$cbIsCopyProtected">
            <label for="ctl00_cphRoblox_cbIsCopyProtected">Copy-Lock my place</label>
        </div>
    </fieldset>
</div>