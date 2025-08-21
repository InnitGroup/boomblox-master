<?php
global $db;
$id = $db->getIdByUser($name);
$avatar = new Avatar($id);
$render = $avatar->GetThumbnail(500, 500, "PNG");
$friend = new User($id);
$location = $friend->isOnline() ? "online at " . $friend->getStatus() : "offline (last seen at " . $friend->lastOnline() . ")";
$status = $friend->isOnline() ? "Online" : "Offline";
#render 500x500
?>
<td>
    <div class="Friend">
        <div class="Avatar">
            <a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_hlAvatar" title="<?=$name?>" href="/User.aspx?ID=<?=$id?>" style="display:inline-block;cursor:pointer;">
                <img src="<?=$render?>" id="img" alt="<?=$name?>" style="height:100px;width:100px;" blankurl="http://t6.roblox.com:80/blank-100x100.gif" border="0">
            </a>
        </div>
        <div class="Summary">
            <span class="OnlineStatus">
                <img id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_iOnlineStatus" src="/images/OnlineStatusIndicator_Is<?=$status?>.gif" alt="<?=$name?> is <?=$location?>)." border="0">
            </span>
            <span class="Name">
                <a id="ctl00_cphRoblox_rbxFriendsPane_dlFriends_ctl01_hlFriend" href="/User.aspx?ID=<?=$id?>"><?=$name?></a>
            </span>
        </div>
    </div>
</td>