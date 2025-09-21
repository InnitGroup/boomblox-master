<div id="pNavigation">
    <div class="Navigation">
        <?php
        if (isset($_GET["PageIndex"])):
            if ($_GET["PageIndex"] > 0): ?>
        <div id="Previous">
            <a href="ClientToolbox.aspx?Category=<?=$category?>&amp;Query=color&amp;PageIndex=<?=isset($_GET["PageIndex"]) ? $_GET["PageIndex"] - 1 : 0?>" id="PreviousPage">
                <span class="NavigationIndicators">&lt;&lt;</span> Prev 
            </a>
        </div>
            <?php endif;
        endif;
        
        if (isset($_GET["PageIndex"])):
            if ((int)$_GET["PageIndex"]*20 < $count): ?>
        <div id="Next">
            <a href="ClientToolbox.aspx?Category=<?=$category?>&amp;Query=color&amp;PageIndex=<?=isset($_GET["PageIndex"]) ? $_GET["PageIndex"] + 1 : 1?>" id="NextPage">Next <span class="NavigationIndicators">&gt;&gt;</span>
            </a>
        </div>
        <?php endif; else: ?>
        <div id="Next">
            <a href="ClientToolbox.aspx?Category=<?=$category?>&amp;Query=color&amp;PageIndex=<?=isset($_GET["PageIndex"]) ? $_GET["PageIndex"] + 1 : 1?>" id="NextPage">Next <span class="NavigationIndicators">&gt;&gt;</span>
            </a>
        </div>
        <?php endif; ?>
        <div id="Location">
            <?=$toolbox->loadPagerLocation()?>
        </div>
    </div>
</div>