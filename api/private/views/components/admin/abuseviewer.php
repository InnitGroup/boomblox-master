<?php
$reportedAbuse;
$type = $abuse["type"];
switch ($type) {
    case "user":
        #$type = "/aaa/images/user.png";
        $reportedAbuse = "/User.aspx?ID=".$abuse["abuse"];
        break;
    case "asset":
        #$type = "/aaa/images/attach.png";
        $reportedAbuse = "/Item.aspx?ID=".$abuse["abuse"];
        break;
    case "chat":
        #$type = "/aaa/images/comments.png";
        break;
}
?>

<div id="MainPanel">
    <div id="Report" style="border:solid 1px black; background-color:white; padding:15px; width:fit-content; text-align:center;">
        <?php if ($type !== "chat"): ?>
            <?php 
            $thumb;
            $render;
            $type == "user" ? $thumb = new Avatar($abuse["abuse"]) : $thumb = new Asset($abuse["abuse"]);
            $type == "user" ? $render = $thumb->GetThumbnail(500, 500, "PNG") : $render = $thumb->getThumbnail(250, 250, "PNG");
            ?>
            <img src="<?=$render?>" style="height:250px;">
        <?php endif; ?>
        <p>Abuse ID: <?=$abuse["id"]?></p>
        <p>Type: <?=ucfirst($type)?></p>
        <p>Reported Abuse: <a href="<?=$reportedAbuse?>" target="_blank"><?=ucfirst($type)?></a></p>
        <p>Informant Comment: <?=htmlspecialchars($abuse["comment"])?></p>
        <p>Informant: <a href="/User.aspx?ID=<?=$abuse["reportedBy"]?>" target="_blank">User</a></p>
        <p>Handled: <img style="position:relative;top:3px;" src="<?=$abuse["handled"] == 1 ? "/aaa/images/accepted.png" : "/aaa/images/stop.png"?>"></p>
        <p>Reported At: <?=$abuse["date"]?></p>

        <?php if ($abuse["handled"] == 0): ?>
        <?php if ($type == "user" || $type == "chat"): ?>
        <button type="button" onclick="window.location.href = '/Admi/Users/ModerateUser.aspx?UserID=<?=$abuse['abuse']?>&AbuseID=<?=$abuse['id']?>';" style="width:230px;">Handle</button>
        <?php elseif ($type == "asset"): ?>
        <?php 
        global $db;
        $stmt = "SELECT creatorId FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => $abuse['abuse']]);
        $fetched = $result->fetch(PDO::FETCH_ASSOC);
        $creatorId = $fetched["creatorId"];
        ?>
        <button type="button" onclick="window.location.href = '/Admi/Users/ModerateUser.aspx?UserID=<?=$creatorId?>&AbuseID=<?=$abuse['id']?>';" style="width:230px;">Handle via User</button><br><br>
        <button type="button" onclick="window.location.href = '/Admi/Moderation/BlockAsset.aspx?AssetID=<?=$abuse['abuse']?>&AbuseID=<?=$abuse['id']?>';" style="width:230px;">Handle via Asset</button>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>