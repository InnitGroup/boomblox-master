<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();

$page = new APageBuilder;

#exit;
#$stmt = "SELECT * as images FROM items WHERE catalogType='Decal'";
#$result = $db->execute($stmt);
#echo $result->fetch(PDO::FETCH_ASSOC)["images"];

exit;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName, itemDescription, lastUpdate) VALUES ('catalog', 'Decal', :creatorId, :creatorName, :itemName, :itemDescription, :lastUpdate)";
    $result = $db->execute($stmt, [
        ":creatorId" => $row["creatorId"],
        ":creatorName" => $row["creatorName"],
        ":itemName" => $row["itemName"],
        ":itemDescription" => $row["itemDescription"],
        ":lastUpdate" => date("Y-m-d H:i:s")
    ]);

    $asset = new File("/api/private/xml/Decal.xml", ["1" => "http://".domain."/asset/?id=" . $row["itemId"]]);
    $asset = $asset->handle();
    $assetId = $db->lastInsertId("items");

    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/$assetId", $asset);
    echo $row["itemId"];
}

exit;
?>