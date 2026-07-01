<?php
global $db, $user;
$viewer = $user;

$stmt = "SELECT playersMax from items where itemId=:itemId";
$result = $db->execute($stmt, [":itemId" => $id]);
$result = $result->fetch(PDO::FETCH_ASSOC);
$max = $result["playersMax"];

$stmt = "SELECT * FROM servers WHERE placeId=:placeId ORDER BY players DESC";
$result = $db->execute($stmt, [":placeId" => $id]);

if ($result->rowCount() > 0):
?>

<?php 
$servers = $result->fetchAll(PDO::FETCH_ASSOC);
foreach ($servers as $server):
?>
<tr>
    <td>
        <div class="GameInstance" style="margin: 3px 0">
            <div style="float: right;">
                <?php
                $players = unserialize($server["playerTable"]);

                foreach ($players as $userId):
                $player = new User($userId);
                $avatar = new Avatar($userId);
                if ($player->isGuest()) {
                    $avatar = new Avatar(1);
                }

                $thumb = $avatar->GetThumbnail(100, 100, "JPG");
                if ($player->isGuest()):
                ?>
                <a id="ctl00_cphRoblox_TabbedInfo_GamesTab_RunningGamesDataList_ctl00_PlayersRepeater_ctl05_PlayerImage" disabled="disabled" title="Guest <?=$player->guestId()?>" style="display:inline-block;">
                    <img src="<?=$thumb?>" style="height:48px;" border="0" alt="Guest <?=$player->guestId()?>">
                </a>
                <?php else: ?>
                <a id="ctl00_cphRoblox_TabbedInfo_GamesTab_RunningGamesDataList_ctl00_PlayersRepeater_ctl05_PlayerImage" disabled="disabled" title="<?=$player->getUsername()?>" href="/User.aspx?id=<?=$userId?>" style="display:inline-block;">
                    <img src="<?=$thumb?>" style="height:48px;" border="0" alt="<?=$player->getUsername()?>">
                </a>
                <?php endif; endforeach; ?>
            </div>
            <div style="text-align: left;"> <?=number_format($server["players"])?> players of <?=$max?> max <br> &nbsp; </div><br>
            <?php if ($user->canAccessPlace($id)): ?>
            <button class="Button" onclick='Roblox.Launch.VisitOnline("http://<?=domain?>/game/join.ashx?t=<?=time()?>&ServerId=<?=$server["id"]?>", <?=$id?>, <?=$server["id"]?>); return false;'>Join</button>
            <?php endif;
            if ($viewer->ownsPlace($id) || $viewer->hasPerms(3)): ?>
                <button class="Button" onclick="RBXGS.Server.Close(<?=$server["id"]?>, <?=$id?>); return false;">Shutdown</button>
            <?php endif; ?>
        </div>
    </td>
</tr>

<?php endforeach; else: ?>
    <p style="text-align: center;">There are no running games for this place.</p>
<?php endif; ?>