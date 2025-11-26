<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$assetId = $_GET["assetnumber"] ?? NULL;

$asset = new Asset($assetId);
echo file_get_contents($asset->GetThumbnail(420, 230, "PNG"));
?>