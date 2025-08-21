<?php
global $db;
?>

<table cellspacing="0" cellpadding="4" border="0" id="ctl00_cphRoblox_UserPunishmentsGridView" bgcolor="White">
    <tbody>
        <tr id="TableHeader">
            <th id="TableHeader" style="min-width:50px; color: white;">ID</th>
            <th id="TableHeader" style="min-width:100px; color: white;">Punishment Type</th>
            <th id="TableHeader" style="min-width:100px; color: white;">Moderator</th>
            <th id="TableHeader" style="min-width:175px; color: white;">Action Date</th>
            <th id="TableHeader" style="min-width:75px; color: white;">Expires</th>
        </tr>
        <?php foreach ($punishments as $key => $punishment): //lightgrey;?>
            <?php
                $unexpirableActions = ["Poison", "Warn", "None", "Reminder", "Delete", "Termination"];
                $backgroundColor = Helper::is_even($key) ? "lightgrey" : "white";
                $id = $punishment["id"];
                $type = $punishment["actionType"];
                $length = (int)$punishment["actionLength"];
                $modId = $db->getUserById($punishment["modId"]);
                $datetime = new DateTime($punishment["actionDate"]);
                $date = $datetime->format("n/j/Y g:i:s A");
                $expirationtime = $datetime->modify("+$length day");
                $expiration = in_array($type, $unexpirableActions) ? "N/A" : $expirationtime->format("n/j/Y g:i:s A");
            ?>
            <tr align="center" style="background-color: <?=$backgroundColor?>;">
                <td><?=$id?></td>
                <td style="text-align: left;"><?=$type?></td>
                <td>
                    <a href="/User.aspx?ID=<?=$punishment["modId"]?>"><?=$modId?></a>
                </td>
                <td><?=$date?></td>
                <td><?=$expiration?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>