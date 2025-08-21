<?php if ($publicView): ?>
    <?=$username?>
<?php else: ?>
    <a href='/My/CustomSettings.aspx' style='color:inherit;text-decoration:none;'>Hi</a>, <?=$username?>!
<?php endif; ?>