<?php
$isAlternate = Helper::is_even($commentPosition);
$alternate = $isAlternate ? "" : "Alternate";

$commentText = htmlspecialchars($comment["content"]);
$commenter = $comment["commenter"];
$commentTime = Helper::timeAgo($comment["commentTime"]);
$commenterId = $comment["commenterId"];
$commenterAvatar = new Avatar($commenterId);
$commenterRender = $commenterAvatar->GetThumbnail(500, 500, "PNG");
?>

<div class="<?=$alternate?>Comment">
    <div class="Commenter">
        <div class="Avatar" style="overflow:hidden;">
            <a href="/User.aspx?ID=<?=$commenterId?>">
                <img style="width:64px;height:64px;" src="<?=$commenterRender?>">
            </a>
        </div>
    </div>
    <div class="Post">
        <div style="position:relative;bottom:7px;" class="Content">
            Posted <?=$commentTime?> by <a href="/User.aspx?ID=<?=$commenterId?>"><?=$commenter?></a>
        </div>
        <div class="Content"><?=$commentText?></div>
    </div>
    <div style="clear:both;"></div>
</div>