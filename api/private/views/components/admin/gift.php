<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 1836;
    $recipients = [
        "marsoc",
"khayden_1",
"pwnzor",
"1o4xy9i8h9fPwnerv1",
"viny",
"red1993",
"TZolta",
"ThePlayerRolo"
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