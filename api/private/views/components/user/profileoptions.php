<?php
global $theme, $user;
$viewerId = $user->getUserId();
$blurb = !empty($blurb) ? $blurb : "";

if ($publicView): ?>
    <?php if ($viewerId !== $userId): ?>
        <?php if (!$user->friendsWith($userId)): ?>
    <p>
        <a href="/My/FriendInvitation.aspx?RecipientID=<?=$userId?>">Send Friend Request</a>
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
<div>
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
</div>
<?php endif; ?>