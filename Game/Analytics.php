<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $db, $auth;

!$auth->isAuthed() && Server::_404();

$page = new PageBuilder(Site::getThemeProperty("alias",$theme)." | Analytics", $theme, "/templates/authheader.php");
$page->buildHeader();



$today = date("Y-m-d");

$stmt = "SELECT COUNT(*) AS total FROM analytics WHERE actiondate = :today";
$result = $db->execute($stmt, [":today" => $today]);
$totalVisits = ($result->rowCount() > 0) ? $result->fetch(PDO::FETCH_ASSOC)["total"] : 0;

$stmt = "
    SELECT player, COUNT(*) AS cnt
    FROM analytics
    WHERE actiondate = :today
    GROUP BY player
    ORDER BY cnt DESC
    LIMIT 1
";
$result = $db->execute($stmt, [":today" => $today]);
$topPlayer = $result->fetch(PDO::FETCH_ASSOC);
$topPlayerCount = $topPlayer["cnt"];
$topPlayer = new User($topPlayer["player"]);
$topPlayer = $topPlayer->getUsername();

$stmt = "
    SELECT place, COUNT(*) AS cnt
    FROM analytics
    WHERE actiondate = :today
    GROUP BY place
    ORDER BY cnt DESC
    LIMIT 1
";
$result = $db->execute($stmt, [":today" => $today]);

if ($result->rowCount() == 0): ?>
<div id="Body">
    No data recorded yet today.
</div>
<?php endif;

$topPlaceId = $result->fetch(PDO::FETCH_ASSOC);

$stmt = "SELECT itemName FROM items WHERE itemId=:itemId";
$result = $db->execute($stmt, [":itemId" => $topPlaceId["place"]]);
$topPlace = $result->fetch(PDO::FETCH_ASSOC)["itemName"];

$topPlaceCount = $topPlaceId["cnt"];
?>

<div id="Body">
    <h2>Analytics</h2>
<?=$totalVisits?> visits today<br>
<?php if ($topPlayer): ?>
    Top player: <?=htmlspecialchars($topPlayer)?> (<?=Helper::is_even($topPlayerCount) ? "$topPlayerCount times" : "$topPlayerCount time"?>)<br>
<?php endif; ?>
<?php if ($topPlace): ?>
    Top place: <?=htmlspecialchars($topPlace)?> (<?=Helper::is_even($topPlaceCount) ? "$topPlaceCount times" : "$topPlaceCount time"?>)<br>
</div>
<?php endif;
$page->buildFooter();
?>