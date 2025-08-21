<div id="PlaceAccess">
    <fieldset title="Access">
        <legend>Access</legend>
        <div class="Suggestion"> This determines who can access your place. </div>
        <div class="PlaceAccessRow">
            <img src="/images/public.png" alt="Public" style="border-width:0px;">
            <input type="radio" name="ctl00$cphRoblox$PlaceAccess" value="rbPublicAccess" <?=$place["access"] == 1 ? 'checked="checked"' : ''?>>
            <label for="ctl00_cphRoblox_rbPublicAccess">Public: Anybody can visit my place</label>
            <br>
            <img src="/images/locked.png" alt="Friends-only" style="border-width:0px;">
            <input type="radio" name="ctl00$cphRoblox$PlaceAccess" value="rbPrivateAccess" <?=$place["access"] == 0 ? 'checked="checked"' : ''?>>
            <label for="ctl00_cphRoblox_rbPrivateAccess">Friends: Only my friends can visit my place</label>
        </div>
    </fieldset>
</div>