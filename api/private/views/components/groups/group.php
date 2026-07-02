<?php
global $user;
$group = new Group($_GET["gid"]);

if (Server::isPost()) {
    if (isset($_POST["__EVENTTARGET"]) && isset($_POST["__EVENTARGUMENT"])) {
        if ($_POST["__EVENTTARGET"] == "Kick") {
            $group->kickMember((int)$_POST["__EVENTARGUMENT"]);
        } elseif ($_POST["__EVENTTARGET"] == "Join") {
            $group->addMember($user->getUserId());
        }
    }
}
?>

<div id="Body">
    <img src="https://t3.xoblog.dev/<?=$group->emblemId()?>.png" style="width:64px;"><br>
    <b>Name:</b> <?=$group->name()?> <b>by</b> <?=$group->creator()->getUsername()?><br>
    <b>Description:</b> <?=$group->description()?><br>
    <b>Members:</b> <?=count($group->members())?>
    <h4>Members</h4>
    <?php foreach ($group->members() as $key => $member): $memberUser = new User($key); $roleset = $group->findRolesetById($member["Roleset"]);?>
        <?=$memberUser->getUsername()?> - <?=$roleset["Name"]?> - <?=$roleset["Rank"]?> - <?=$roleset["Description"]?> - <a href="javascript:__doPostBack('Kick', '<?=$memberUser->getUserId()?>')">Kick</a>
    <?php endforeach; ?>
    <h4>Rolesets</h4>
    <?php foreach ($group->rolesets() as $roleset): ?>
        <?=$roleset["Rank"] . " - " . $roleset["Name"] . " - " . $roleset["Description"] . "<br>"?>
    <?php endforeach; ?>
    <?php if (!$group->isInGroup($user->getUserId())): ?>
        <a href="javascript:__doPostBack('Join', '<?=$user->getUserId()?>')">Join</a>
    <?php endif; ?>
</div>