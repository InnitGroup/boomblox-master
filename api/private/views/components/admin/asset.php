<?=$key == 0 || $key % 3 == 0 ? "<tr>" : ""?>
<td id="Asset">
    <span id="AssetName"><?=htmlspecialchars($name)?></span><br>
    <img id="AssetImage" onclick="javascript:__checkAsset(this)" src="<?=$texture?>"><br>
    <div id="AssetOptions">
        <input type="radio" name="<?=$id?>" value="OK<?=$isAd ? "_AD" : ""?>" checked>
        <label>OK</label><br>
        <input type="radio" name="<?=$id?>" value="Punish<?=$isAd ? "_AD" : ""?>">
        <label>Punish</label><br>
        <input type="radio" name="<?=$id?>" value="Block<?=$isAd ? "_AD" : ""?>">
        <label>Block</label>
    </div>
</td>