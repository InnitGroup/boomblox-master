<?php
global $theme;
?>

<div id="Body">
    <div class="SearchBar">
        <h4>You found an in-development page, wooo!</h4>
    </div>
    <h2>Instructions</h2>
    <p>On <?=Site::getThemeProperty("alias", $theme)?>, users can bid an amount of tickets to buy advertising for their places, clothing and models. To create an ad:</p><br>
    <ol>
        <li>
            <p>First you need to choose which size ad you want to make. There are currently three options. Each has a template that you can download to help you get started:</p><br>
            <p><a href="#">Download 728 x 90 Banner Template</a></p><br>
            <p><a href="#">Download 160 x 600 Skyscraper Template</a></p><br>
            <p><a href="#">Download 300 x 250 Large Rectangle Template</a></p><br>
        </li>
        <li><p>Use image editing software to craft an enticing ad.</p></li>
        <li><p>Save the customized ad to your computer.</p></li>
        <li><p>Click the "Upload" button below.</p></li>
        <li><p>Use the File Explorer that pops up to browse your computer.</p></li>
        <li><p>Find and select the newly created ad.</p></li>
    </ol><br>
    <p>
        The ad you have uploaded will be reviewed by our team of moderators, please allow several hours for this process. Once your ad has been approved, you will be able to launch the ad from your <a href="/My/AdInventory.aspx">Ad Inventory</a> page.
    </p>
    <p>
        Crafting an effective ad is an art. A good ad can get you more visitors for less money compared to a poor ad. For tips and tricks, read the tutorial <a href="https://rbxlegacy.wiki/index.php?title=How_to_Design_an_Effective_Ad">How To Design an Effective Ad.</a>
    </p><br>
    <p><b>Upload an Ad</b></p>
    <input id="filename" type="text" name="filename" disabled="" value="">
    <input type="file"><br>
    <p><b>Name your ad (users will see this text when they mouse-over your ad)</b></p>
    <input type="text" maxlength="50" class="TextBox" style="margin-bottom:5px"><br>
    <a class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbUpload','')">Upload</a>
</div>