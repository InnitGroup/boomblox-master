<?php
global $user;
?>

<body bgcolor="buttonface" scroll="no">
    <script>
        function __doPostBack(eventTarget, eventArgument) {
            document.aspnetForm.__EVENTTARGET.value = eventTarget;
            document.aspnetForm.__EVENTARGUMENT.value = eventArgument;
            document.aspnetForm.submit();
        }
    </script>
    <form name="aspnetForm" method="POST">
        <div style="padding-top:10px;padding-left:20px;padding-right:20px;padding-bottom:20px;">
            <p>This will send a complete report to a moderator. The moderator will review the chat log and take appropriate action.</p>
            <br>
            <span>Please choose the player you wish to report:</span>
            <select name="ctl00$robloxCph$reportedUser">
                <?php
                    $players = Gameservers::getPlayers($user->getPlayingServerId());
                    foreach ($players as $playerId) {
                        $player = new User($playerId); ?>
                        <option name="a" value="<?=$playerId?>"><?=$player->getUsername()?></option>
                    <?php } ?>
            </select>
            <button type="submit">Continue</button>
            <button onclick="window.close()">Cancel</button>
        </div>
    </form>
</body>