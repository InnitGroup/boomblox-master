<?php
#made: 03/14/2025 @marsoc
#last edit: 04/06/2025 @marsoc: acclimation to assetdelivery v2
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $db;

$assetId = $_GET["id"] ?? $_GET["ID"] ?? Server::_404();

new AssetRedirect($assetId);