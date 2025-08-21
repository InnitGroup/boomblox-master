<?php
global $theme;
if ($publicView): ?>
    <?=$username?>'s <?=Site::getThemeProperty("alias", $theme)?>:
<?php else: ?>
    Your <?=Site::getThemeProperty("alias", $theme)?>:
<?php endif; ?>