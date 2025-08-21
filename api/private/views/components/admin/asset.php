<?=$key == 0 || $key % 3 == 0 ? "<tr>" : ""?>
<td id="Asset">
    <span id="AssetName"><?=htmlspecialchars($name)?></span><br>
    <img id="AssetImage" onclick="javascript:__checkAsset(this)" src="<?=$texture?>"><br>
    <div id="AssetOptions">
        <input type="radio" name="<?=$id?>" value="OK" checked>
        <label>OK</label><br>
        <input type="radio" name="<?=$id?>" value="Punish">
        <label>Punish</label><br>
        <input type="radio" name="<?=$id?>" value="Block">
        <label>Block</label>
    </div>
</td>