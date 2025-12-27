<?php
global $theme;
$userId = $user->getData("user", "id");
$username = $user->getData("user", "username");
$blurb = $user->getData("user", "blurb");
$availablePlaces = $user->getAvailablePlaces()
?>
<div id="ProfilePane">
    <table id="ProfilePaneBackground" width="100%" bgcolor="<?=($theme !== 4 ? "lightsteelblue" : "")?>" cellpadding="6" cellspacing="0">
        <tr>
            <td>
                <span class="Title"><?=PageBuilder::addComponent("user", "profileusername", compact("username", "publicView"))?></span>
                <br>
                <?php if ($publicView) PageBuilder::addComponent("user", "useronlinestatus", compact("user"))?>
            </td>
        </tr>
        <tr>
            <td>
                <span><?=PageBuilder::addComponent("user", "panelurl", compact("username", "publicView"))?></span>
                <br/>
                <a href="User.aspx?ID=<?=$userId?>">http://www.<?=Site::getThemeProperty("url",$theme)?>/User.aspx?ID=<?=$userId?></a>
                <br/>
                <br/>
                <div style="height:340px; width:220px; left: 0px; float: left; position: relative; top: 60px">
                    <a disabled="disabled" title="<?=$username?>" onclick="return false" style="display:inline-block;">
                        <img style="height:220px;" src="<?=$avatar->GetThumbnail(540,660,"PNG")?>" border="0" alt="<?=$username?>" blankUrl="http://t2.xoblog.dev/blank-180x220.gif" />
                    </a>
                    <br />
                    <?php if ($publicView) {PageBuilder::addComponent("user", "abuse", compact("userId"));}?>
                </div>
                <?=PageBuilder::addComponent("user", "profileoptions", compact("availablePlaces", "publicView", "blurb", "userId"))?>
            </td>
        </tr>
    </table>
    <?php if ($user->hasBC()): ?>
    <h4><?=Site::getThemeProperty("membership", $theme)?> Member until <?=$user->bcExpires()?></h4>
    <?php endif; ?>
</div>
<?=Ad::generateAd("300x250")?>