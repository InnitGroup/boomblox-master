<?php
global $theme;

$userId = $user->getData("user", "id");
$username = $user->getData("user", "username");
$blurb = $user->getData("user", "blurb");
$availablePlaces = $user->getAvailablePlaces();
?>
<div class="StandardBox" style="background-color:#D0E4FE;">
    <table width="100%" bgcolor="#D0E4FE" cellpadding="2" cellspacing="0">
        <tr>
            <td style="text-align:center;">
                <?php if ($publicView) PageBuilder::addComponent("user", "useronlinestatus", compact("user"))?>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;"> 
                <span><?=PageBuilder::addComponent("user", "panelurl", compact("username", "publicView"))?></span>
                <br/>
                <a href="User.aspx?ID=<?=$userId?>">http://www.<?=Site::getThemeProperty("url", $theme)?>/User.aspx?ID=<?=$userId?></a>
                <br/>
                <br/>
                <div style="<?=!$publicView ? 'height:340px; width:220px; left: 0px; float: left; position: relative; top: 60px' : 'left: 0px; float: left; position: relative; top: 0px'?>">
                    <a disabled="disabled" title="<?=$username?>" onclick="return false" style="display:inline-block;">
                        <img style="height:220px;" src="<?=$avatar->GetThumbnail(540,660,"PNG")?>" border="0" alt="<?=$username?>" blankUrl="http://t2.<?=domain?>/blank-180x220.gif" />
                    </a>
                    <br />
                    <?php if ($publicView) {PageBuilder::addComponent("user", "abuse", compact("userId"));}?>
                </div>
                <?=PageBuilder::addComponent("user", "profileoptions", compact("availablePlaces", "publicView", "blurb", "userId"))?>
            </td>
        </tr>
    </table>
    <?php if ($user->hasBC() || $user->hasTBC()): if (!$publicView): ?>
    <div style="text-align:center" class="SubscriptionStatusPanel"><?=$user->hasTBC() ? "Turbo " . Site::getThemeProperty("membership", $theme) : ""?> Subscriber (renews <?=$user->bcExpires()?>)</div>
    <?php endif; endif; ?>
</div>

<?=Ad::generateAd("300x250")?>