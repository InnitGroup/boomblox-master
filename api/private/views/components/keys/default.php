<div id="MainPanel">
    <?php
    global $db, $user;
    $stmt = "SELECT * FROM `keys` WHERE creator=:creator AND `status`=1";
    $result = $db->execute($stmt, [":creator" => $user->getUserId()]);
    if ($result->rowCount() > 0):
    ?>
        <?php
        $keys = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($keys as $key):
        ?>
            <?="BOOMBLOX-".$key["keyC"]."<br>"?>
        <?php endforeach; ?>
    <?php else: ?>
        You have no active keys.
    <?php endif; ?>
</div>