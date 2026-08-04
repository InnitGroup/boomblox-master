<div id="Body">
        <div id="ContentBuilderContainer">
            <h2>Decal Builder</h2><br>
            
            <div class="InstructionsPanel">
                <h3>Instructions</h3>
                <p>On <?=Site::getThemeProperty("alias", $theme)?>, a Decal is an image that can be applied to one of a part's faces. To create a Decal:</p>
                <ol>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the picture that you want to use as your decal. Any standard image (.png, .jpg) will work.</li>
                    <li>Finally, click the "Create Decal" button.</li>
                </ol>
                <p>The image you selected will be uploaded to <?=Site::getThemeProperty("alias", $theme)?>, where we will create a Decal and add it to your inventory. To use this Decal, simply open the <b>Insert</b> menu in <?=Site::getThemeProperty("alias", $theme)?>, select Object then Decal, in the Decal's properties you should find a <b>Texture</b> property. Set the Texture property to <b><?=Site::$domain?>/asset/?id=YOUR_DECAL_ID</b>, you can find the ID of your Decal by going to it in your inventory then checking the URL. You can drag the Decal onto the part you wish to decorate.</a></p>
            </div>