<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);?>

<style>
    #AssetTable, tr, th {
        border: 1px solid;
    }
</style>

<table id="AssetTable" style="border: 1px solid;">
    <tr>
        <th>Name</th>
        <th>ID</th>
        <th>File Name</th>
    </tr>
    <?php
    global $db;
    $stmt = "SELECT * FROM items WHERE itemType='catalog' AND catalogType IN ('Shirt', 'Pants', 'T-Shirt') ORDER BY itemId ASC";
    $result = $db->execute($stmt);
    if ($result->rowCount() > 0) {
        $items = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            PageBuilder::addComponent("admin", "listedasset", compact("item"));
        }
    }
    ?>
</table>