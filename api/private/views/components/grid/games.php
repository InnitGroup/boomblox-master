<?php
global $db;
?>

<div id="MainPanel">
    <h1>Games</h1>
    <p>Running games:</p>
    <table class="AdmiTable">
        <tr>
            <th>Place ID</th>
            <th>Players</th>
            <th>Running since</th>
        </tr>
        <?php
        $games = Gameservers::getActive();
        foreach ($games as $game):
        ?>
        <tr>
            <td><a href="/Item.aspx?ID=<?=$game["placeId"]?>"><?=$game["placeId"]?></a></td>
            <td><?=$game["players"]?> out of <?=Gameservers::getMax($game["id"])?> max</td>
            <td><?=Helper::timeAgo($game["started"])?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>Waiting games:</p>
    <ol></ol>
</div>