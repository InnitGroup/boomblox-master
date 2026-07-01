<?php
if (Server::isPost()) {
    Group::new($_POST["GroupName"], $_POST["GroupDesc"], (int)$_POST["GroupEmblemId"], 0, 1, 1);
}
?>

<div id="MainPanel">
    <label>Group Name: </label>
    <input type="text" name="GroupName"><br>
    <label>Group Description: </label>
    <input type="text" name="GroupDesc"><br>
    <label>Group Emblem Id: </label>
    <input type="text" name="GroupEmblemId"><br>
    <input type="submit" value="Create Group">
</div>