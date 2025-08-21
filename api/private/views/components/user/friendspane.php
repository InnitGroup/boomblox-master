<div id="FriendsPane">
    <div id="Friends">
        <h4><?=$publicView ? $username."'s" : "My"?> Friends 
            <a href="Friends.aspx?UserID=<?=$userId?>">See all <?=$friendCount?></a>
            <?php if (!$publicView): ?>
                (<a href="/My/EditFriends.aspx">Edit</a>)
            <?php endif; ?>
        </h4>
        <table cellspacing="0" align="Center" border="0">
            <?=$friends?>
        </table>
    </div>
</div>