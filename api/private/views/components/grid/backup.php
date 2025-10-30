<?php
if (Server::isPost()) {
    Admin::backupDatabase();
}
?>

<div id="MainPanel">
    <input type="submit" value="Backup database">
</div>