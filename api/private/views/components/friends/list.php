<?php
global $user;

if (!isset($data)) {
    $data = file_get_contents("php://input");
    $data = json_decode($data);
} else {
    $data = (object)$data;
}

$page = $data->page;
$userId = $data->userId;

$viewedUser = new User($userId);
$username = $viewedUser->getUsername();
$friends = $viewedUser->getFriends(false);

$pages = ceil(count($friends) / 36);
?>

<h4><?=$userId == $user->getUserId() ? "My" : $username."'s"?> Friends (<?=count($friends)?>)</h4>

<div id="ctl00_cphRoblox_rbxFriendsPane_Pager1_PanelPages" align="center">
     Pages: 
    <?php if ($page < $pages): ?>
        <a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonNext" href='javascript:__doWebPostBack("api/public/views/Friends.php", "Friends", {"userId": <?=$userId?>, "page": <?=$page+1?>});'>Next &gt;&gt;</a>
    <?php elseif ($page < $pages): ?>
        <a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonPrevious" href='javascript:__doWebPostBack("api/public/views/Friends.php", "Friends", {"userId": <?=$userId?>, "page": <?=$page-1?>});'>&lt;&lt; Previous</a>
        <a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonNext" href='javascript:__doWebPostBack("api/public/views/Friends.php", "Friends", {"userId": <?=$userId?>, "page": <?=$page+1?>});'>Next &gt;&gt;</a>
    <?php elseif ($page == $pages && $pages > 1): ?>
        <a id="ctl00_cphRoblox_rbxFriendsPane_Pager1_LinkButtonPrevious" href='javascript:__doWebPostBack("api/public/views/Friends.php", "Friends", {"userId": <?=$userId?>, "page": <?=$page-1?>});'>&lt;&lt; Previous</a>
    <?php endif; ?>
</div>

<table id="ctl00_cphRoblox_rbxFriendsPane_dlFriends" cellspacing="0" align="Center" border="0">
    <tbody>
        <tr>
        <?php
        if (empty($friends)) {
            echo Site::noResults("{$username} has no friends.") . "</tr>";
        } else {
            $offset = ($page-1)*36;
            $friends = array_slice($friends, $offset, 36);
            foreach ($friends as $key => $name) {
                PageBuilder::addComponent("friends", "friend", compact("name"));
                if (($key + 1) % 6 == 0) {
                    echo "</tr>";
                }
            }
        }
        ?>
    </tbody>
</table>