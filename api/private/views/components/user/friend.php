<?php
$senderUsername = $friendRequest["senderUn"];
$senderId = $friendRequest["senderId"];
$senderAvatar = new Avatar($senderId);
$senderRender = $senderAvatar->GetThumbnail(500, 500, "PNG");
$invitationId = $friendRequest["messageId"];

$friend = new User($senderId);
$location = $friend->isOnline() ? "online at " . $friend->getStatus() : "offline (last seen at " . $friend->lastOnline() . ")";
$statusIndicator = $friend->isOnline() ? "Online" : "Offline";

$imageUrl = $friendInvitation ? "/My/FriendInvitation.aspx?InvitationID={$invitationId}" : "/User.aspx?ID={$senderId}";
?>

<td>
    <div class="Friend">
        <div class="Avatar">
            <a title="<?=$senderUsername?>" href="<?=$imageUrl?>" style="display:inline-block;cursor:pointer;">
                <img style="height:100px;" src="<?=$senderRender?>" border="0" alt="<?=$senderUsername?>" blankurl="http://t6.roblox.com:80/blank-100x100.gif">
            </a>
        </div>
        <div class="Summary">
            <span class="OnlineStatus">
                <img src="images/OnlineStatusIndicator_Is<?=$statusIndicator?>.gif" alt="<?=$senderUsername?> is <?=$location?>)." border="0">
            </span>
            <span class="Name">
                <a href="User.aspx?ID=<?=$senderId?>"><?=$senderUsername?></a>
            </span>
        </div>
    </div>
</td>