<?php
global $theme, $user, $db;
$viewerId = $user->getUserId();
$blurb = !empty($blurb) ? $blurb : "";

if ($publicView): ?>
    <?php if ($viewerId !== $userId): ?>
        <?php if (!$user->friendsWith($db->getUserById($userId))): ?>
    <p>
        <a href="/My/FriendInvitation.aspx?RecipientID=<?=$userId?>">Send Friend Request</a>
    </p>
        <?php elseif ($user->isStaff() && !$user->bestFriendsWith($userId)): ?>
    <p>
        <a href="javascript:__doPostBack('','')">Make Best Friend</a>
    </p>        
        <?php elseif ($user->bestFriendsWith($userId)): ?>
    <p>
        <a href="javascript:__doPostBack('','')">Remove Best Friend</a>
    </p>         
        <?php endif; ?>
    <p>
        <a href="/My/PrivateMessage.aspx?RecipientID=<?=$userId?>">Send Message</a>
    </p>
    <?php endif; ?>
    <p>
        <span><?=(strip_tags($blurb))?></span>
    </p>
<?php else: ?>
<div style="text-align: left">
    <p>
        <a href="/My/Inbox.aspx">Inbox</a>
    </p>
    <p>
        <a href="/My/Character.aspx">Change Character</a>
    </p>
    <p>
        <a href="/My/Profile.aspx">Edit Profile</a>
    </p>
    <p>
        <a href="/Upgrades/BuildersClub.aspx">Account Upgrades</a>
    </p>
    <p>
        <a href="/My/AccountBalance.aspx">Account Balance</a>
    </p>
    <p>
        <a href="/User.aspx?ID=<?=$viewerId?>&ForcePublicView=true">View Public Profile</a>
    </p>
    <p>
        <a href="javascript:__doPostBack('','ct100$rbx$CreatePlace')">Create New Place</a><br>
        <span style="color:white;">(<?=$availablePlaces?> Remaining)</span>
    </p>
    <p>
        <a href="/My/InviteAFriend.aspx">Share <?=Site::getThemeProperty("alias", $theme)?></a>
    </p>
    <p>
        <a href="/My/InviteAFriend.aspx">Buy <?=Site::getThemeProperty("currency", $theme)?></a>
    </p>
    <p>
        <a href="/Marketplace/TradeCurrency.aspx">Trade Currency</a>
    </p>
    <p>
        <a href="/My/AdInventory.aspx">Ad Inventory</a>
    </p>
    <p>
        <a href="/info/TermsOfService.aspx">Terms, Conditions, and Rules</a>
    </p>
</div>
<?php endif; ?>