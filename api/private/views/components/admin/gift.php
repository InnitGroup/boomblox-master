<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 203;
    $recipients = [
"marsoc",
"EPICW3B",
"explorer",
"bee027",
"1o4xy9i8h9fPwnerv1",
"kainsteronyt",
"pwnzor",
"Adam",
"platos",
"nox",
"idontknowwhat",
"G2HJS",
"chicken",
"Spades",
"phil",
"jamster",
"Zanryth",
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