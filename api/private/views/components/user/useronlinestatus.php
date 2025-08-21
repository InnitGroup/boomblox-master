<?php if ($user->isOnline()): ?>
    <span class="UserOnlineMessage">[ Online: <?=$user->getStatus()?> ]</span>
<?php else: ?>
    <span class="UserOfflineMessage">[ Offline ]</span>
<?php endif; ?>