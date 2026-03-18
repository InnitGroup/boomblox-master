<?php
global $auth, $db, $user;

if (Server::isPost()) {
    if ($user->hasPerms(7) && isset($_POST["InstallerName"])) {
        $installer = $_POST["InstallerName"];
        if (Client::getMd5($installer) !== NULL) {
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/cdn/t0/bv.txt", $installer);
            file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/cdn/t0/version.txt", Client::getMd5($installer));
        }
    }
}
?>

<div id="MainPanel">
    <p>Current version: <?=file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/cdn/t0/version.txt")?> | <?=file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/cdn/t0/bv.txt")?></p>
    <h1>Version Deployer</h1>
    <label for="InstallerName">Name: </label><br>
    <input type="text" name="InstallerName"><br>
    <input type="submit">
</div>