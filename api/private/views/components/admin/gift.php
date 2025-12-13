<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 1991;
    $recipients = [
"Boomblox",
"marsoc",
"1o4xy9i8h9fPwnerv1",
"explorer",
"kainsteronyt",
"pwnzor",
"platos",
"TZolta",
"chicken",
"phil",
"nox",
"G2HJS",
"JohnDoe",
"Spades",
"viny"
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