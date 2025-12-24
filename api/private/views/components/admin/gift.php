<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 2144;
    $recipients = [
    "kainsteronyt",
    "platos",
    "Zanryth",
    "khayden_1",
    "tobu.fi",
    "viny",
    "pwnzor",
    "ThePlayerRolo",
    "1o4xy9i8h9fPwnerv1",
    "bee027",
    "urgir",
    "marsoc",
    ];
    foreach ($recipients as $recipient) {
        global $db;
        $userId = $db->getIdByUser($recipient);
        $_user = new User($userId);
        if (!$_user->hasItem($gift)) {
            $_user->giveItem($gift);
        }
    }
    ?>
</div>