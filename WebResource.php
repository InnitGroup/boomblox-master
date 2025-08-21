<?php
#made: 04/01/2025 @marsoc
#last edit: 04/01/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

$web = new WebResource($_GET["d"]);
header("Content-Type: ".$web->contentType);
?>
