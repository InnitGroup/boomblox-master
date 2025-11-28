<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme;
$data = file_get_contents("php://input");
$data = json_decode($data, true);
if (!isset($data)) {
    Server::_404();
}

$page = $data["page"];
$id = $data["id"];
$action = $data["action"]; // previous // next

$newPage = 1;
switch ($action) {
    case "previous":
        $newPage = $page-1;
        break;
    case "next":
        $newPage = $page+1;
        break;
    default:
        $newPage = 1;
        break;
}

$stmt = "SELECT COUNT(*) FROM comments WHERE itemId=:itemId ORDER BY commentTime DESC";
$result = $db->execute($stmt, [":itemId" => $id]);
$fetched = $result->fetch(PDO::FETCH_ASSOC);
$commentCount = $fetched["COUNT(*)"];

$stmt = "SELECT * FROM comments WHERE itemId=:itemId ORDER BY commentTime DESC LIMIT 10";
if ($newPage !== 1) {
    $offset = ($newPage-1)*10;
    $stmt .= " OFFSET ".$offset;
}



$result = $db->execute($stmt, [":itemId" => $id]);
if ($result->rowCount() > 0) {
    $commentData = $result->fetchAll(PDO::FETCH_ASSOC);
    $page = $newPage;
    PageBuilder::addComponent("commentary", "main", compact("commentData", "commentCount", "page"));
}

?>