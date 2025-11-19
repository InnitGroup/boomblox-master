<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user;
$modelData = gzdecode(file_get_contents("php://input"));

if (isset($_GET["ID"])) {
    $modelId = (int)$_GET["ID"];
    if (!$user->madeModel($modelId)) {
        exit;
    }

    $stmt = "UPDATE items SET `lastUpdate` = :lastUpdate WHERE `itemId` = :modelId";
    $db->execute($stmt, [
        ":lastUpdate" => date("Y-m-d H:i:s"),
        ":modelId" => $modelId
    ]);
    
    $file = new File("/content/$modelId");
    $file->links();

    $file = fopen($_SERVER["DOCUMENT_ROOT"]."/content/$modelId", "w");
    fwrite($file, $modelData);
    fclose($file);

    $asset = new Asset($modelId);
    $asset->RequestThumbnail(250, 250, "PNG");
    exit;
}

$file = fopen($_SERVER["DOCUMENT_ROOT"]."/content/temp/".$user->getUserId(), "w");
fwrite($file, $modelData);
fclose($file);
exit;
?>