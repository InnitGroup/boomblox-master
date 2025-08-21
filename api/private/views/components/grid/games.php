<?php
global $db;
?>

<div id="MainPanel">
    <h1>Games</h1>
    <p>Running games:</p>
    <ol>
        <?php
        $games = Gameservers::getActive();
        foreach ($games as $game):
        ?>
        <li><a href="/Item.aspx?ID=<?=$game["placeId"]?>">Game</a> - <?=$game["players"]." out of ".Gameservers::getMax($game["id"])." max"?></li>
        <?php endforeach; ?>
    </ol>
    <p>Waiting games:</p>
    <ol></ol>
</div>