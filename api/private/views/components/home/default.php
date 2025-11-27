<div id="Body">
    <div id="SplashContainer">
        <?php if (!Server::isIE7()): ?>
        <script>
            window.RufflePlayer = window.RufflePlayer || {};
            window.RufflePlayer.config = {
                "autoplay": "on",
                "unmuteOverlay": "hidden",
                "splashScreen": false
            };
        </script>
        <?php endif; ?>
        <?php
        PageBuilder::addComponent("home", "signinpane");
        PageBuilder::addComponent("home", "ataglance");
        PageBuilder::addComponent("home", "coolplaces");
        ?>
    </div>
</div>