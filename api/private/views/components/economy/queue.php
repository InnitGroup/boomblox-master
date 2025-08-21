<?php
global $db, $user;

$stmt = "SELECT COUNT(*) AS admins FROM users WHERE `level` > 2";
$result = $db->execute($stmt);
$admins = $result->fetch(PDO::FETCH_ASSOC)["admins"];
$required = Helper::is_even(round(abs($admins/2))) ? round(abs($admins/2))+1 : round(abs($admins/2));
?>

<div id="MainPanel">
    <?php
    $error = '';
    
    if (Server::isPost()) {
        if (isset($_POST["__EVENTARGUMENT"]) && isset($_POST["__EVENTTARGET"])) {
            $stmt = "SELECT participants FROM itemqueue WHERE id=:id";
            $result = $db->execute($stmt, [":id" => $_POST["__EVENTARGUMENT"]]);
            $preparticipants = $result->fetch(PDO::FETCH_ASSOC)["participants"];
            $participated = false;
            if ($preparticipants !== null) {
                $participants = unserialize($preparticipants);
                if (in_array($user->getUserId(), $participants)) {
                    $participated = true;
                }
            } else {
                $participants = array();
            }
            
            switch ($_POST["__EVENTTARGET"]) {
                case 'ctl$cphRoblox$Yes':
                    if ($participated) {break;}

                    $stmt = "UPDATE itemqueue SET `yes` = `yes` + 1, participants=:participants WHERE id=:id";
                    array_push($participants, $user->getUserId());
                    $finalParticipants = serialize($participants);
                    $db->execute($stmt, [
                        ":participants" => $finalParticipants,
                        ":id" => $_POST["__EVENTARGUMENT"]
                    ]);

                    break;
                case 'ctl$cphRoblox$No':
                    if ($participated) {break;}

                    $stmt = "UPDATE itemqueue SET `no` = `no` + 1, participants=:participants WHERE id=:id";
                    array_push($participants, $user->getUserId());
                    $finalParticipants = serialize($participants);
                    $db->execute($stmt, [
                        ":participants" => $finalParticipants,
                        ":id" => $_POST["__EVENTARGUMENT"]
                    ]);

                    break;
                case 'ctl$cphRoblox$Continue':
                    if (!$user->hasPerms(7)) {break;}

                    $stmt = "SELECT * FROM itemqueue WHERE id=:id";
                    $result = $db->execute($stmt, [":id" => $_POST["__EVENTARGUMENT"]]);
                    $queuedItem = $result->fetch(PDO::FETCH_ASSOC);
                    if (($queuedItem["yes"] + $queuedItem["no"]) < $required) {break;}
                    if ($queuedItem["catalogType"] == 4) {$error = 'Heads cannot be uploaded yet.'; break;}

                    $stmt = "UPDATE itemqueue SET complete=1 WHERE id=:id";
                    $db->execute($stmt, [":id" => $_POST["__EVENTARGUMENT"]]);

                    $stmt = "INSERT INTO items (itemType, catalogType, itemName, itemDescription, creatorName, creatorId, `status`, lastUpdate, creationDate) VALUES ('catalog', :catalogType, :itemName, :itemDescription, 'Boomblox', 1, 'accepted', :lastUpdate, :creationDate)";
                    $db->execute($stmt, [
                        ":catalogType" => Helper::itemType($queuedItem["catalogType"])->Type,
                        ":itemName" => $queuedItem["itemName"],
                        ":itemDescription" => $queuedItem["itemDescription"],
                        ":lastUpdate" => date("Y-m-d H:i:s"),
                        ":creationDate" => date("Y-m-d H:i:s")
                    ]);

                    $stmt = "SELECT itemId FROM items ORDER BY itemId DESC LIMIT 1";
                    $result = $db->execute($stmt);
                    $fetched = $result->fetch(PDO::FETCH_ASSOC);
                    $itemId = $fetched["itemId"];

                    $file = $queuedItem["tempName"];
                    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/$itemId", file_get_contents($file));

                    $item = new Asset($itemId);
                    $item->RequestThumbnail(250, 250, "PNG");

                    $boomblox = new User(1);
                    $boomblox->giveItem($itemId);

                    break;
            }
        }
    }
    ?>
    <h1>Item Queue</h1>
    <p>All items uploaded will be found here for voting.</p>
    <p><b>Capable delegates:</b> <?=$admins?></p>
    <p><b>Required total votes:</b> <?=$required?></p>
    <hr>
    <?php
    $stmt = "SELECT * FROM itemqueue WHERE complete=0 ORDER BY id ASC LIMIT 5";
    $result = $db->execute($stmt);
    $queuedItems = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($queuedItems as $queue => $item):
    ?>
    <div style="margin:5px;">
        <b><?=htmlspecialchars($item["itemName"])?></b> | <i><?=Helper::itemType($item["catalogType"])->Type?></i>
        <p><?=htmlspecialchars($item["itemDescription"])?></p>
        <button onclick="javascript:__doPostBack('ctl$cphRoblox$Yes','<?=$item["id"]?>')">Yes</button>
        &nbsp;|&nbsp;
        <button onclick="javascript:__doPostBack('ctl$cphRoblox$No','<?=$item["id"]?>')">No</button>
        <p><?=$item["yes"]?>-<?=$item["no"]?></p>
        <?php if (($item["yes"] + $item["no"]) >= $required && $user->hasPerms(7)): ?>
        <button onclick="javascript:__doPostBack('ctl$cphRoblox$Continue','<?=$item["id"]?>')">Continue</button>
        <?php endif; ?>
        <hr>
    </div>
    <?php endforeach; ?>
    <?php if (!empty($error)): ?>
    <p style="color:red"><?=$error?></p>
    <?php endif; ?>
</div>