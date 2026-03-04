<div id="Body">
    <div id="ConfigurePlaceContainer">
        <h2>Configure Place</h2>
        
        <?php if (isset($_POST['__EVENTTARGET'])): if ($_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$lbSubmit'): ?>
        <div id="EditItemContainer">
            <div id="Confirmation" class="Suggestion" style="font-size: 12px;">Your changes to the item have been saved. (<?=date("h:i:s A")?>)</div>
        </div>
        <?php Server::_self(3); endif; endif; ?>