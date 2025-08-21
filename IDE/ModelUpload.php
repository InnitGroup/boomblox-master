<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

#$modelData = gzdecode(file_get_contents("php://input"));

$model = new ModelManager;
$model->handleSave();
?>