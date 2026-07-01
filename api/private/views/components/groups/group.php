<?php
$group = new Group($_GET["gid"]);
?>

<div id="Body">
    <img src="https://t3.xoblog.dev/<?=$group->emblemId()?>.png" style="width:64px;"><br>
    <b>Name:</b> <?=$group->name()?> <b>by</b> <?=$group->creator()->getUsername()?><br>
    <b>Description:</b> <?=$group->description()?><br>
    <b>Members:</b> <?=count($group->members())?>
    <h4>Members</h4>
    <?php foreach ($group->members() as $key => $member): $memberUser = new User($key); $roleset = $group->findRolesetById($member["Roleset"]);?>
        <?=$memberUser->getUsername()?> - <?=$roleset["Name"]?> - <?=$roleset["Rank"]?> - <?=$roleset["Description"]?>
    <?php endforeach; ?>
    <h4>Rolesets</h4>
    <?php foreach ($group->rolesets() as $roleset): ?>
        <?=$roleset["Rank"] . " - " . $roleset["Name"] . " - " . $roleset["Description"] . "<br>"?>
    <?php endforeach; ?>
</div>