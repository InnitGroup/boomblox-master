<div id="PlaceThumbnail">
    <a disabled="disabled" supportsalphachannel="False" title="<?=htmlspecialchars(Helper::debugString($place["itemName"]))?>" onclick="return false" style="display:inline-block;height:230px;width:420px;">
        <img src="<?=$asset->GetThumbnail(420, 230, "PNG")?>" border="0" id="img" alt="<?=htmlspecialchars(Helper::debugString($place["itemName"]))?>">
    </a>
</div>