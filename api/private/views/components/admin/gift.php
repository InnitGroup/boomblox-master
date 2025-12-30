<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 1865;
    $item = 2230;

    global $db;
    $recentUsers = $db->getAllUsersThisMonth()->fetchAll(PDO::FETCH_ASSOC);
    foreach ($recentUsers as $recentUser) {
        $inventory = unserialize($recentUser["items"]);
        if (in_array($gift, $inventory)) {
            $recipient = new User($recentUser["id"]);
            $recipient->giveItem($item);
        }
    }
    ?>
</div>