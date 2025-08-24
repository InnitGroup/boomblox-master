<?php
#made: 04/01/2025 @marsoc
#last edit: 04/01/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$d = $_GET["d"] ?? Server::_404();
$web = new WebResource($d);
header("Content-Type: ".$web->contentType);
?>
