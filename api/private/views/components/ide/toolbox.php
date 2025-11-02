<tr>
<?php if ($result->rowCount() == 0): ?>
    <span>No models available.</span>
<?php endif;

foreach ($fetched as $order => $model): ?>
        <td class="ToolboxItem" ondragstart="dragRBX(<?=$model['itemId']?>)" onmouseover="this.style.borderStyle='outset'" onmouseout="this.style.borderStyle='solid'" style="border-style: solid;">
            <a id="dlToolboxItems_ctl00_ciToolboxItem" title="<?=htmlspecialchars($model['itemName'])?>" href="javascript:insertContent(<?=$model['itemId']?>)" ondrag="javascript:dragRBX(<?=$model['itemId']?>)" style="display:inline-block;height:60px;width:60px;cursor:pointer;">
                <img style="width:56px;" src="<?php $asset = new Asset($model['itemId']); echo $asset->GetThumbnail(250, 250, "PNG");?>" border="0" id="img" alt="<?=htmlspecialchars($model['itemName'])?>">
            </a>
        </td>
    <?php if (($order+1) % 2 == 0): ?>
    </tr>
    <?php endif; ?>
<?php endforeach;