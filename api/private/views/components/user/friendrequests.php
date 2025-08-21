<?php
$friendInvitation = true;

global $db;
$stmt = "SELECT * FROM messages WHERE inviteActive=1 AND recipientId=:userId";
$result = $db->execute($stmt, [":userId" => $user->getData("user", "id")]);
$requests = 0;
if ($result->rowCount() > 0) {
    $requests = $result->rowCount();
    $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
} 

if ($requests > 0): ?>

<div class="FriendRequestsPane" id="FriendRequests">
    <h4>Friend Requests (<?=$requests?>)</h4>
    <span>
        <a href="javascript:__doPostBack('', 'ctl00$FriendRequests$AcceptAll')">Accept All</a>
        &nbsp;|&nbsp;
        <a href="javascript:__doPostBack('', 'ctl00$FriendRequests$DeclineAll')">Decline All</a>
    </span>
    <table cellspacing="0" align="Center" border="0">
        <tbody>
            <tr>
                <?php 
                    if (isset($fetched)) {
                        foreach ($fetched as $friendRequest) {
                            PageBuilder::addComponent("user", "friend", compact("friendRequest", "friendInvitation"));
                        }
                    }
                ?>
            </tr>
        </tbody>
    </table>
    <div class="FooterPager">
        <span>
            <span style="color:#dcdcdc;">First</span>
            <span style="color:#dcdcdc;">Previous</span>
            <span>1</span>
            <span style="color:#dcdcdc;">Next</span>
            <span style="color:#dcdcdc;">Last</span>
        </span>
    </div>
</div>

<?php endif; ?>