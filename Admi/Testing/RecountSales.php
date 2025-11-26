<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;
exit;
$users = $db->getAllUsers();
foreach ($users as $_user) {
    $newUser = new User($_user["id"]);
    $items = $newUser->getItems("Model");
    foreach ($items as $item) {
        $stmt = "UPDATE items SET interactions = interactions + 1 WHERE itemId=:itemId";
        $db->execute($stmt, [":itemId" => $item["itemId"]]);
    }
}

?>