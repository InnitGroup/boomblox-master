<tr>
    <?php
        for ($i = 0; $i < $option["Level"]; $i++) {
            PageBuilder::addComponent("admin", "levelidentifier");
        }
    ?>

    <td>
        <a href="<?=$option["Link"]?>" id="ctl<?=Helper::cphIdentifier($optionKey)?>_TreeView1t0i" tabindex="-1">
            <img src="/WebResource.axd?d=tce8FDaK7R0GBVxHP9c8yLtasErGofxcnEGyEUTof9AetA5-YPEOCwXmpH3_WE6R0&amp;t=633527605112930887" alt="" border="0" />
        </a>
    </td>
    <td>
        <a href="<?=$option["Link"]?>" id="ctl<?=Helper::cphIdentifier($optionKey)?>_TreeView1t0">
            <b><?=$option["Title"]?></b>
        </a>
    </td>
</tr>