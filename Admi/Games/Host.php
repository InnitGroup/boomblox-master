<?php
#exit;
?>

<script>
    function click() {
        alert(1);
        var app = window.external.GetApp();
        var workspace = app.CreateGame(44340105256);    // Window
        workspace.ExecUrlScript("http://xoblog.dev/Game/gameserver.ashx?t=<?=time()?>")
    }
</script>

<a href="javascript:click()">Host</a>