<div id="Body">
        <div id="ContentBuilderContainer">
            <h2>T-Shirt Builder</h2><br>
            
            <div class="InstructionsPanel">
                <h3>Instructions</h3>
                <p>On <?=Site::getThemeProperty("alias", $theme)?>, a T-Shirt is a transparent torso adornment with a decal applied to the front surface. To create a T-Shirt:</p>
                <ol>
                    <li>Click the "Browse" button below.</li>
                    <li>Use the File Explorer that pops up to browse your computer.</li>
                    <li>Find and select the picture that you want to use as the shirt's decal. Any standard image (.png, .jpg, .gif) will work.</li>
                    <li>Finally, click the "Create T-Shirt" button.</li>
                </ol>
                <p>The texture you created will be uploaded to <?=Site::getThemeProperty("alias", $theme)?>, where we will create a T-Shirt and add it to your inventory. To wear this T-Shirt, simply go to the <a href="/My/Character.aspx">Change Character</a> page, find it in your wardrobe, and click to wear it.</p>
            </div>