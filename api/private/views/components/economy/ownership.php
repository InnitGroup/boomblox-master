<div id="MainPanel">
    <p>This is a utility page, has no user interface for input other than GET parameters in the URI</p>
    <hr>
    <?php
    if (isset($_GET["ItemID"])) {
    $owners = Admin::getOwners($_GET["ItemID"]);
    foreach ($owners as $owner):
    ?>
    <p><?=$owner?></p>
    <?php endforeach; } ?>
</div>