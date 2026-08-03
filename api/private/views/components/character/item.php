<td class="Asset" id="<?=$item["itemId"]?>">
    <a class="WearItem" title="click to wear" href="javascript:__doPostBack(\'Accoutrement\', \'<?=$this->requestData["type"]?>$<?=$item["itemId"]?>$Wear\')" onclick="wearItem(event)">[ wear ]</a>
    <a href="javascript:__doPostBack(\'Accoutrement\', \'<?=$this->requestData["type"]?>$<?=$item["itemId"]?>$Wear\')">
    <img class="AssetThumbnail" style="height:64px;" src="<?=$thumbnail->GetThumbnail(250,250,"PNG")?>">
    </a>
    <div class="AssetName">
        <a href="/Item.aspx?ID=<?=$item["itemId"]?>"><?=htmlspecialchars(Helper::debugString($item["itemName"]))?></a>
    </div>
    <div class="AssetDetails Label">
        <span>Creator: <a href="/User.aspx?ID=<?=$item["creatorId"]?>"><?=$item["creatorName"]?></a></span>
    </div>
</td>