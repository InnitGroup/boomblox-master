<?php
class Site {
    private static $themes = [
        [
            "name" => "Boomblox",
            "alias" => "Boomblox",
            "company" => "?",
            "company2" => "?",
            "year" => "2026. Experimental project.",
            "url" => "bmblox.xyz",
            "xmlUrl" => "www-bmblox-xyz",
            "logo" => "BoombloxLogo.png",
            "favicon" => "bbxfavicon.ico",
            "logoDimensions" => "width:267px;height:55px;top:11px;",
            "css" => "AllCSS0.ashx",
            "3char" => "bbx",
            "currency" => "Boombux",
            "currencyIcon" => "Boombux",
            "membership" => "Bombers Club",
            "shortCurrency" => "B$"
        ],
        [
            "name" => "Roblox",
            "alias" => "ROBLOX",
            "company" => "ROBLOX Corporation",
            "company2" => "ROBLOX Corp.",
            "year" => "©2009. Patents pending.",
            "url" => "roblox.com",
            "xmlUrl" => "www-roblox-com",
            "logo" => "RobloxLogo2.png",
            "favicon" => "roblox.ico",
            #"logoDimensions" => "width:218px;height:56px;top:9px;",
            "logoDimensions" => "top:8px;",
            "css" => "AllCSS1.ashx",
            "3char" => "bbx",
            "currency" => "ROBUX",
            "currencyIcon" => "ROBUX",
            "membership" => "Builders Club",
            "shortCurrency" => "R$"
        ],
        [
            "name" => "Protonium",
            "alias" => "Protonium",
            "company" => "Exploco",
            "company2" => "Exploco",
            "year" => "2023. Proto.",
            "url" => "prtnim.lol",
            "xmlUrl" => "www-prtniim-lol",
            "logo" => "ProtoniumLogo.png",
            "favicon" => "protonium.ico",
            "logoDimensions" => "top:12px;",
            "css" => "AllCSS2.ashx",
            "3char" => "ptn",
            "currency" => "Robux",
            "currencyIcon" => "ROBUX",
            "membership" => "Builders Club",
            "shortCurrency" => "R$"
        ],
        [
            "name" => "Roblox",
            "alias" => "ROBLOX",
            "company" => "ROBLOX Corporation",
            "company2" => "ROBLOX Corp.",
            "year" => "©2007. Patents pending.",
            "url" => "roblox.com",
            "xmlUrl" => "www-roblox-com",
            "logo" => "RobloxLogo.png",
            "favicon" => "roblox.ico",
            "logoDimensions" => "width:267px;height:70px;",
            "css" => "AllCSS3.ashx",
            "3char" => "bbx",
            "currency" => "ROBUX",
            "currencyIcon" => "RobuxCoin",
            "membership" => "Builders Club",
            "shortCurrency" => "R$"
        ],
        [
            "name" => "Boomblox",
            "alias" => "Boomblox",
            "company" => "?",
            "company2" => "?",
            "year" => "2026. Experimental project.",
            "url" => "bmblox.xyz",
            "xmlUrl" => "www-bmblox-xyz",
            "logo" => "BoombloxLogo.png",
            "favicon" => "bbxfavicon.ico",
            "logoDimensions" => "width:267px;height:55px;top:11px;",
            "css" => "AllCSS4.ashx",
            "3char" => "bbx",
            "currency" => "Boombux",
            "currencyIcon" => "Boombux",
            "membership" => "Bombers Club",
            "shortCurrency" => "B$"
        ],
        [
            "name" => "GoodBlox",
            "alias" => "GOODBLOX",
            "company" => "ROBLOX Corporation",
            "company2" => "ROBLOX Corp.",
            "year" => "©2009. Patents pending.",
            "url" => "goodblox.xyz",
            "xmlUrl" => "www-roblox-com",
            "logo" => "goodblox_logo.png",
            "favicon" => "gb_favicon.ico",
            "logoDimensions" => "width:257px;height:67px;",
            "css" => "AllCSS3.ashx",
            "3char" => "gbx",
            "currency" => "GOODBUX",
            "currencyIcon" => "ROBUX",
            "membership" => "Builders Club",
            "shortCurrency" => "G$"
        ]
    ];
    public static $domain = "http://".url;
    public static $noHttpDomain = url;
    public static $standaloneDomain = url;
    public static function getThemeProperty($property, $themeId = 0) {
        return self::$themes[$themeId][$property] ?? NULL;
    }
    public static function noResults($string) {
        return '
            <p class="NoResults"><span>'.$string.'</span></p>
        ';
    }
    public static function currentShout(): string {
        global $db;

        $stmt = "SELECT `text` FROM shoutbox ORDER BY shoutId DESC LIMIT 1";
        $result = $db->execute($stmt);
        
        return $result->fetch(PDO::FETCH_ASSOC)["text"];
    }
}
?>