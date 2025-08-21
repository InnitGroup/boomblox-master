<div id="MainPanel">
    <h1>Grid Manager</h1>
    <p>Overseer and manage the grid</p>
    <hr>
    <p><?=Gameservers::gridOnline() ? "Running" : "Offline"?></p>
    <?php if (Gameservers::gridOnline()): ?>
    <a href="javascript:__doPostBack('ctl$robloxCph$Restart','')">Restart</a>
    <?php else: ?>
    <a href="javascript:__doPostBack('ctl$robloxCph$Start','')">Start</a>
    <?php endif; ?>
    <br><br>
    <?php
    global $user;
    if (Server::isPost()) {
        if (isset($_POST["__EVENTTARGET"])) {
            if ($user->hasPerms(5)) {
                switch ($_POST["__EVENTTARGET"]) {
                    case 'ctl$robloxCph$Restart':
                        Gameservers::restartGrid();
                        echo '<script>window.location = "/Admi/Grid/Manage.aspx"</script>';
                        break;
                    case 'ctl$robloxCph$Start':
                        Gameservers::startGrid();
                        echo '<script>window.location = "/Admi/Grid/Manage.aspx"</script>';
                        break;
                }
            } else {
                echo 'You do not have the required permissions to perform this action.';
            }   
        }
    }
    ?>
</div>