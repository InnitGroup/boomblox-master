<div style="margin-top:10px;" class="StandardBoxHeader"><?=$publicView ? $username."'s" : "My"?> Friends 
            <a style="color:yellow" href="Friends.aspx?UserID=<?=$userId?>">See all <?=$friendCount?></a>
            <?php if (!$publicView): ?>
                (<a style="color:yellow" href="/My/EditFriends.aspx">Edit</a>)
            <?php endif; ?></div>

<div class="StandardBox">
    <table cellspacing="0" align="Center" border="0">
        <?=$friends?>
    </table>
</div>