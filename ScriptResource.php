<?php
#made: 01/18/2025 @marsoc
#last edit: 03/06/2025 @marsoc: OpenPlace()
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-Type: application/javascript");

$data = $_GET["d"] ?? base64_encode("data");
new ScriptResource($data);

?>