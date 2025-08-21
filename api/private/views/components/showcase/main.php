<?php
$place = new Asset(1);
$thumbnail = $place->GetThumbnail(300, 300, "PNG");
$wideThumbnail = $place->GetThumbnail(420, 230, "PNG");
?>

<div id="Body">
    <div id="ConfigureShowcase">
        <h2>Configure Showcase</h2>
        <blockquote>
            Use this page to configure which Places in your inventory are showcased for the <?=Site::getThemeProperty("alias", $theme)?> community to enjoy.
            Your showcased Places will be available from the <a href="/Games.aspx">Games</a> page, as well as featured on your user page.
            You earn Tickets when <?=Site::getThemeProperty("name", $theme)?>ians visit your Showcase Places, so make sure to highlight your very best creations to encourage tourism!
            <br><br>
            To update your Showcase:
            <br><br>
                <li>Click and drag the picture of your Place to change the order of the items in your Showcase.</li>
                <li>Remove Places from your Showcase by clicking the REMOVE button.</li>
                <li>Browse your Places inventory and change the Places in your Showcase using the finder at the top of the page.</li>
            <br><br>
            <span class="Attention">Gain the ability to add more Places to your showcase by signing up for <a href="/Upgrades/BuildersClub.aspx">Builders Club</a> today!</span>
        </blockquote>
        <div>
            <h3>0 of your 1 Showcase slots are filled.</h3><br>
            <span>Places Inventory Finder:</span>
        </div>
        <div class="ItemArea">
            <div style="display:inline-block;">
                <div>
                    <img src="<?=$thumbnail?>">
                </div>
                <div>
                    <a href="/Item.aspx?ID=1">mucrone</a>
                </div>
            </div>
            <div style="display:inline-block;">
                <div>
                    <img src="<?=$thumbnail?>">
                </div>
                <div>
                    <a href="/Item.aspx?ID=1">mucrone</a>
                </div>
            </div>
            <div style="display:inline-block;">
                <div>
                    <img src="<?=$thumbnail?>">
                </div>
                <div>
                    <a href="/Item.aspx?ID=1">mucrone</a>
                </div>
            </div>
            <div style="display:inline-block;">
                <div>
                    <img src="<?=$thumbnail?>">
                </div>
                <div>
                    <a href="/Item.aspx?ID=1">mucrone</a>
                </div>
            </div>
        </div>
        <div style="clear:both; margin-bottom:30px;">
        </div>
        <div>
            <li style="float:left;">
                <img style="float:left;width:180px;height:100px;border-right: solid 1px #000" src="<?=$wideThumbnail?>">
                <span style="float:left;font-size:1.25em;padding:5px;">mucrone</span>
                <a style="float:right;bottom:80px;margin:5px 50px;" class="Button">Remove</a>
            </li>
        </div>
    </div>
</div>