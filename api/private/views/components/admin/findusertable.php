<hr>
<p>User Search Results:</p>
<table style="border-collapse:collapse;">
    <tbody>
        <tr id="TableHeader">
            <th id="TableHeader" style="min-width:50px; color: white;">Name</th>
            <th id="TableHeader" style="min-width:50px; color: white;">ID</th>
            <th id="TableHeader" style="min-width:50px; color: white;">Online</th>
            <th id="TableHeader" style="min-width:75px; color: white;">Email</th>
            <th id="TableHeader" style="min-width:75px; color: white;">RoleSet</th>
            <th id="TableHeader" style="min-width:175px; color: white;">Creation Date</th>
            <th id="TableHeader" style="min-width:175px; color: white;">Last Activity</th>
            <th id="TableHeader" style="color: white;">Appearance</th>
            <th id="TableHeader" style="min-width:100px; color: white;">Last Seen</th>
            <th id="TableHeader" style="min-width:75px; color: white;">BC</th>
            <th id="TableHeader" style="color: white;">Moderation</th>
            <th id="TableHeader" style="min-width:125px; color: white;">Moderate User</th>
        </tr>
        <?php foreach ($users as $key => $user): ?>
            <?php 
                $userObj = new User($user["id"]);
                $backgroundColor = Helper::is_even($key) ? "lightgrey" : "white";
                $online = $userObj->isOnline() ? "checked" : "";
                $userId = $user["id"];
                $username = $user["username"];
                $email = $user["email"];
                $roleset = $userObj->getRoleset();
                $creationDate = date("n/j/Y g:i:s A", strtotime($user["reg_date"]));
                $lastDate = date("n/j/Y g:i:s A", strtotime($user["lastOnline"]));
                $lastSeen = $userObj->getStatus() == $user["lastOnline"] ? $userObj->getStatus() : "Website";
                $bc = $userObj->hasBC() ? "BC" : "None";
                $moderation = Admin::getPunishments($userId) ? "Bad" : "OK";
            ?>
        <tr align="center" style="background-color: <?=$backgroundColor?>;">
            <td>
                <a href="ModerateUser.aspx?UserID=<?=$userId?>"><?=$username?></a>
            </td>
            <td><?=$userId?></td>
            <td>
                <input type="checkbox" <?=$online?> disabled="">
            </td>
            <td><?=$email?></td>
            <td><?=$roleset?></td>
            <td><?=$creationDate?></td>
            <td><?=$lastDate?></td>
            <td>
                <input type="checkbox" disabled="">
            </td>
            <td><?=$lastSeen?></td>
            <td><?=$bc?></td>
            <td><?=$moderation?></td>
            <td>
                <input type="checkbox" onchange="window.location.href='ModerateUser.aspx?UserID=<?=$userId?>'">
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>