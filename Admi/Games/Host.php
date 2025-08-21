<?php
exit;
?>

<script>
    function click() {
        alert(1);
        var app = window.external.GetApp();
        var workspace = app.CreateGame(2);    // Window
        workspace.ExecUrlScript("http://bmblox.xyz/Game/gameserver.ashx?t=<?=time()?>")
    }
</script>

<a href="javascript:click()">Host</a>