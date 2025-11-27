<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$assetId = $_GET["assetid"] ?? NULL;

$asset = new Asset($assetId);
$path = $asset->GetThumbnail(420, 230, "PNG"); 
$src = imagecreatefrompng($path);

$dst = imagecreatetruecolor(120, 70);
imagecopyresampled($dst, $src, 0, 0, 0, 0, 120, 70, 420, 230);

header("Content-Type: image/png");
imagepng($dst);

imagedestroy($src);
imagedestroy($dst);
?>