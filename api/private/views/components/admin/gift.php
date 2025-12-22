<div id="MainPanel">
    <p>Utility panel for giving gifts to specific users</p>
    <?php
    $gift = 2141;
    $recipients = [
"marsoc",
"bee027",
"kainsteronyt",
"thereal",
"Zanryth",
"jamster",
"pwnzor",
"grenbiguy",
"viny",
"ThePlayerRolo",
"khayden_1",
"killeroid7",
"Spades",
"tobu.fi",
"SONIC32XMARS",
"urgir",
"Pengu",
"red1993",
"duud6",
"Spookie17654",
"xs08c",
"AeroDynamix",
"nox",
"TZolta",
"platos",
"chicken",
"Pwner Argentino",
"EPICW3B",
"worker",
"Supa",
"G2HJS",
"Adam",
"Boomblox",
"jacek",
"madstingray",
"MaskotGame",
"epic",
"doge",
"sore",
"credit",
"Tixguy211",
"tmr",
"AtoZenne",
"Valahul",
"Mugny",
"hyperdash38"
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