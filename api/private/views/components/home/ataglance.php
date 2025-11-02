<div id="RobloxAtAGlance">
    <?php
    global $theme;
    $alias = Site::getThemeProperty("alias", $theme);
    ?>
    <h2><?=$alias?> Virtual Playworld</h2>
    <h3><?=$alias?> is Free!</h3>
    <ul id="ThingsToDo">
        <li id="Point1">
            <h3>Build your personal Place</h3>
            <div>Create buildings, vehicles, scenery, and traps with thousands of virtual bricks.</div>
        </li>
        <li id="Point2">
            <h3>Meet new friends online</h3>
            <div>Visit your friend\'s place, chat in 3D, and build together.</div>
        </li>
        <li id="Point3">
            <h3>Battle in the Brick Arenas</h3>
            <div>Play with the slingshot, rocket, or other brick battle tools.  Be careful not to get "bloxxed".</div>
        </li>
    </ul>
    <div id="Showcase" onload="MM_CheckFlashVersion(\'8,0,0,0\',\'Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?\');">
        <script src="https://unpkg.com/@ruffle-rs/ruffle"></script>
        <object width="400" height="326">
            <param name="movie" value="/aaa.swf">
            <embed src="/aaa.swf">
            </embed>
        </object>
    </div>
    <div id="Install"><br></div>
    <div id="ctl00_cphRoblox_pForParents">
        <div id="ForParents">
            <a id="ctl00_cphRoblox_hlKidSafe" title="<?=$alias?> is kid-safe!" href="Parents.aspx" style="display:inline-block;"><img title="<?=$alias?> is kid-safe!" src="images/COPPASeal-125x125.jpg" border="0"/></a>
        </div>
    </div>
</div>