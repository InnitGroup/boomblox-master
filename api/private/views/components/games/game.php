<?php
$name = htmlspecialchars(Helper::debugString($game["itemName"]));
$id = $game["itemId"];
$lastUpdate = Helper::timeAgo($game["lastUpdate"]);
$creatorId = $game["creatorId"];
$creatorName = $game["creatorName"];
$favorites = Helper::times(number_format($game["favorites"]));
$visits = Helper::times($game["interactions"]);
$gears = $game["gears"];
$genre = $game["genre"];
$allCategoriesSet = Category::allCategoriesSet($game["itemId"]);
?>

<div style="height: 175px; width: 180px; float: left;">
    <div style="margin-left:18px">
        <div class="GameThumbnail12" style="margin: 0; width: 160px; height: 100px; border: 1px solid black;">
            <a title="<?=$name?>" href="Item.aspx?ID=<?=$id?>" style="display:inline-block;cursor:pointer;">
                <img src="<?=$asset->GetThumbnail(420, 230, "PNG")?>" border="0" alt="<?=$name?>" style="width:160px;height:100px;">
            </a>
        </div>
        <div class="GameDetails12" style="margin: 0; width: 160px;">
            <div class="GameName">
                <img id="ctl00_cphRoblox_rbxGames_GamesRepeater_ctl04_GenreIcon" class="GamesInfoIcon" src="/images/GenreIcons/<?=Genre::genreName($genre)?>.png" alt="<?=Genre::genreName($genre)?>" border="0">
                <?php if ($allCategoriesSet): ?>
                    <img id="ctl00_cphRoblox_rbxGames_GamesRepeater_ctl05_GearIcon" class="GamesInfoIcon" src="/images/Suitcase16x16.png" alt="Allows gear" border="0">
                <?php elseif (!$allCategoriesSet && $gears !== NULL): ?>
                    <img id="ctl00_cphRoblox_rbxGames_GamesRepeater_ctl05_GearIcon" class="GamesInfoIcon" src="/images/GenreSuitcase16x16.png" alt="Allows select gear" border="0">
                <?php endif; ?>
                <a href="Item.aspx?ID=<?=$id?>"><?=$name?></a>
            </div>
            <div class="GameCreator">
                <span class="Label">Creator:</span> <span class="Detail"><a href="User.aspx?ID=<?=$creatorId?>"><?=$creatorName?></a></span>
            </div>
            <div class="GamePlays">
                <span class="Label">Played: </span> <span class="Detail"><?=$visits?></span>
            </div>
            <div>
                <span class="DetailHighlighted">
                <?php if ($players > 0) {
                    if ($players == 1) { ?>
                        <?=$players?> player online
                    <?php } else { ?>
                        <?=number_format($players)?> players online
                    <?php }
                }?>
                </span>
            </div>
        </div>
    </div>
</div>