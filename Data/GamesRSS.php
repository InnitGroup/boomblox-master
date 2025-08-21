<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

header("Content-Type: text/plain");
$currentDate = date("D, d M Y H:i:s e");
?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:fh="http://purl.org/syndication/history/1.0">
	<channel> 
        <atom:link href="http://www.roblox.com/Games.aspx?feed=rss" rel="self" type="application/rss+xml" />
        <title>ROBLOX Games - Most Popular (Now)</title>
        <link>http://<?=Site::$domain?>/Games.aspx</link>
        <description>A feed of ROBLOX Games</description>
        <copyright>Copyright 2008, ROBLOX Corporation</copyright>
        <generator>ROBLOX RSS</generator>
        <pubDate><?=$currentDate?></pubDate>
        <docs>http://cyber.law.harvard.edu/rss/rss.html</docs>
        <fh:complete /> 
        <image>
            <url>http://<?=Site::$domain?>/images/logo_rss.PNG</url>
            <title>ROBLOX Games - Most Popular (Now)</title>
            <link>http://<?=Site::$domain?>/Games.aspx</link>
            <width>118</width>
            <height>31</height>
        </image>
        <?php
        global $db;
        $stmt = "
            SELECT i.*, 
            SUM(s.players) AS totalPlayers
            FROM items i
            LEFT JOIN servers s ON s.placeId = i.itemId AND s.players > 0
            WHERE i.itemType = 'game' AND i.status = 'accepted'
            GROUP BY i.itemId
            ORDER BY totalPlayers DESC, i.interactions DESC
            LIMIT 15;
        ";
        $result = $db->execute($stmt);
        if ($result->rowCount() > 0) {
            $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fetched as $game): 
            $pubDate = date("D, d M Y H:i:s e", strtotime($game["creationDate"]));
            ?>
<item>
            <title><?=htmlspecialchars($game["itemName"])?></title>
            <link>http://<?=Site::$domain?>/Item.aspx?ID=<?=$game["itemId"]?></link>
            <guid>http://<?=Site::$domain?>/Item.aspx?ID=<?=$game["itemId"]?></guid>
            <pubDate><?=$pubDate?></pubDate>
            <description><a href="http://<?=Site::$domain?>/Item.aspx?ID=<?=$game["itemId"]?>" title="<?=htmlspecialchars($game["itemName"])?>"><img src="http://<?=Site::$domain?>/" width="160" height="100" autocomplete="<?=htmlspecialchars($game["itemName"])?>"><?=isset($game["itemDescription"]) ? htmlspecialchars($game["itemDescription"]) : "No description available"?></description>
        </item>
            <?php endforeach; 
        }
        ?>
    </channel>
</rss>