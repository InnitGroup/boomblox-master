<?php
global $db;

$cphIdentifier = Helper::cphIdentifier($key);
$userId = $db->getIdByUser($friend);
$friend = new User($userId);
$username = $friend->getUsername();

$avatar = new Avatar($userId);
$render = $avatar->GetThumbnail(500, 500, "PNG");

$location = $friend->isOnline() ? "online at " . $friend->getStatus() : "offline (last seen at " . $friend->lastOnline() . ")";
$statusIndicator = $friend->isOnline() ? "Online" : "Offline";
?>
<td>
    <div class="Friend" onmouseover="this.style.borderStyle='outset';this.style.margin='6px'" onmouseout="this.style.borderStyle='none';this.style.margin='10px'" style="border-style: none; margin: 10px;">
        <div class="Avatar">
            <a id="ctl00_cphRoblox_rbxEditFriendsPane_dlFriends_ctl00_hlAvatar" title="<?=$username?>" href="/User.aspx?ID=<?=$userId?>" style="display:inline-block;height:100px;width:100px;cursor:pointer;">
                <img src="<?=$render?>" border="0" alt="<?=$username?>" style="height:100px;">
            </a>
        </div>
        <div class="Summary">
            <span class="OnlineStatus">
                <img id="ctl00_cphRoblox_rbxEditFriendsPane_dlFriends_ctl00_iOnlineStatus" src="../images/OnlineStatusIndicator_Is<?=$statusIndicator?>.gif" alt="<?=$username?> is <?=$location?>)." style="border-width:0px;">
            </span>
            <span class="Name">
                <a id="ctl00_cphRoblox_rbxEditFriendsPane_dlFriends_ctl00_hlFriend" href="../User.aspx?ID=<?=$userId?>"><?=$username?></a>
            </span>
        </div>
        <div class="Options">
            <button name="ctl00$cphRoblox$rbxEditFriendsPane$dlFriends$ctl00$bDelete" value="ctl<?=$cphIdentifier?>$cphRoblox$rbxEditFriendsPane$<?=$userId?>$dlFriends$ctl<?=$cphIdentifier?>$bDelete" id="cphRoblox_rbxEditFriendsPane_dlFriends_bDelete">Delete</button>
        </div>
    </div>
</td>