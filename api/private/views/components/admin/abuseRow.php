<?php
$backgroundColor = Helper::is_even($key) ? "lightgrey" : "white";
$image;
$abuse;
switch ($report["type"]) {
    case "user":
        $type = "/aaa/images/user.png";
        $abuse = "/User.aspx?ID=".$report["abuse"];
        break;
    case "asset":
        $type = "/aaa/images/attach.png";
        $abuse = "/Item.aspx?ID=".$report["abuse"];
        break;
    case "chat":
        $type = "/aaa/images/comments.png";
        break;
}

$report["handled"] == 1 ? $handled = "/aaa/images/accepted.png" : $handled = "/aaa/images/stop.png";
?>

<tr align="center" style="background-color: <?=$backgroundColor?>;">
    <td><?=$report["id"]?></td>
    <td><img title="<?=$report["type"]?>" src="<?=$type?>"></td>
    <td><a href="<?=$abuse?>" target="_blank"><?=$report["abuse"]?></a></td>
    <td><?=$report["comment"]?></td>
    <td><a href="/User.aspx?ID=<?=$report["reportedBy"]?>" target="_blank"><?=$report["reportedBy"]?></td>
    <td><img title="<?=(string)$report["handled"]?>" src="<?=$handled?>"></td>
    <td><?=$report["date"]?></td>
    <td><input type="checkbox" <?=$report["handled"] == 1 ? "disabled" : ""?> onchange="window.location.href = '/Admi/Moderation/AbuseViewer.aspx?AbuseID=<?=$report["id"]?>'"></td>
</tr>