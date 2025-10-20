<?php
global $user, $theme;
$asset = new Asset($place["itemId"]);
$hasAccess = false;

if ($place["access"] == 1) {
    $hasAccess = true;
}

if ($user->friendsWith($place["creatorName"])) {
    $hasAccess = true;
}

if ($user->getUserId() == $place["creatorId"]) {
    $hasAccess = true;
}
?>

<script src="/ScriptResource.axd?d=aWRl"></script>
<div class="AccordionHeader" onclick="javascript:OpenPlace(<?=$id?>)"> <?=htmlspecialchars($place["itemName"])?> </div>
    <div style="display:<?=$display?>;" id="PlaceContent<?=$id?>" class="PlaceContent">
        <div class="Place">
            <div class="PlayStatus">
                <span style="display: <?=!$user->friendsWith($place["creatorName"]) && $place["access"] == 0 && $user->getUserId() !== $place["creatorId"] ? "inline" : "none"?>">
                    <img src="images/locked.png" alt="Locked" border="0" />&nbsp;Friends-only </span>
                <span style="display: <?=$user->friendsWith($place["creatorName"]) && $place["access"] == 0 || $user->getUserId() == $place["creatorId"] && $place["access"] == 0 ? "inline" : "none"?>">
                    <img src="images/unlocked.png" alt="Unlocked" border="0" />&nbsp;Friends-only: You have access </span>
                <span style="display: <?=$place["access"] == 1 ? "inline" : "none"?>">
                    <img src="images/public.png" alt="Public" border="0" />&nbsp;Public </span>
                    <br>
            </div>
            <div class="PlayOptions">
                <div class="modalPopup" style="display: none">
                    <div style="margin: 1.5em">
                        <div id="Spinner" style="float:left;margin:0 1em 1em 0">
                            <img src="images/ProgressIndicator2.gif" alt="Progress" border="0" />
                        </div>
                        <div id="Requesting" style="display: inline"> Requesting a server</div>
                        <div id="Waiting" style="display: none"> Waiting for a server</div>
                        <div id="Loading" style="display: none"> A server is loading the game</div>
                        <div id="Joining" style="display: none"> The server is ready. Joining the game...</div>
                        <div id="Error" style="display: none"> An error occured. Please try again later</div>
                        <div id="Expired" style="display: none"> There are no game servers available at this time. Please try again later</div>
                        <div id="GameEnded" style="display: none"> The game you requested has ended</div>
                        <div id="GameFull" style="display: none"> The game you requested is full. Please try again later</div>
                        <div style="text-align: center; margin-top: 1em">
                            <input id="Cancel" type="button" class="Button" value="Cancel" />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="ctl00$cphRoblox$rbxUserPlacesPane$ctl02$rbxPlatform$rbxVisitButtons$rbxPlaceLauncher$HiddenField1"/>
                <?php if ($hasAccess): ?>
                <div style="display:inline">
                    <input type="Image" src="/images/Play<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" id="ctl00_cphRoblox_VisitButtons_hlMultiplayerVisit" onclick='alert("You are in client, visit online is not supported yet!")'>
                </div>
                <?php if ($user->ownsPlace($place["itemId"])): ?>
                <div style="display:inline"> &nbsp;&nbsp;&nbsp; <input type="Image" src="/images/Build.png" onclick='Roblox.Launch.StartGame("http:\/\/<?=domain?>/Game/Edit.ashx?PlaceID=<?=$place["itemId"]?>&t=<?=time()?>", "NA", 3, <?=$place["itemId"]?>)'>
                </div>
                <?php elseif ($place["onsale"] == 2): ?>
                <div style="display:inline"> &nbsp;&nbsp;&nbsp; <input type="Image" src="/images/PlaySolo<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" onclick='javascript:Roblox.Launch.StartGame("http:\/\/<?=domain?>/Game/visit.ashx?PlaceID=<?=$place["itemId"]?>&t=<?=time()?>", "NA", 2, <?=$place["itemId"]?>)'></div>
                <?php else: ?>
                <div style="display:inline"> &nbsp;&nbsp;&nbsp; <input type="Image" src="/images/PlaySolo<?=$theme == 0 || $theme == 4 ? "BMBLX" : ""?>.png" disabled></div>
                <?php endif; endif; ?>
            </div>
            <div class="Statistics">
                <span>Visited <?=number_format($place["interactions"])?> times ( last week)</span>
            </div>
            <div class="Thumbnail">
                <a disabled="disabled" title="<?=htmlspecialchars($place["itemName"])?>" href="/Item.aspx?ID=<?=$place["itemId"]?>" style="display:inline-block;">
                    <img src="<?=$asset->GetThumbnail(420, 230, "PNG")?>" border="0" alt="<?=htmlspecialchars($place["itemName"])?>" />
                </a>
            </div>
            <?php if (!empty($place["itemDescription"])): ?>
            <div class="Description">
                <span><?=htmlspecialchars($place["itemDescription"])?></span>
            </div>
            <?php endif; ?>
            <?php if (!$publicView): ?>
            <div class="Configuration">
                <a href="/My/Place.aspx?ID=<?=$place["itemId"]?>">Configure this Place</a>
            </div>
            <?php endif; ?>
        </div>
    </div>