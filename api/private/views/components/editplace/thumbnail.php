<div id="PlaceThumbnail">
    <a disabled="disabled" supportsalphachannel="False" title="<?=htmlspecialchars($place["itemName"])?>" onclick="return false" style="display:inline-block;height:230px;width:420px;">
        <img src="<?=$asset->GetThumbnail(420, 230, "PNG")?>" border="0" id="img" alt="<?=htmlspecialchars($place["itemName"])?>">
    </a>
</div>