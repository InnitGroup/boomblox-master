<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

#$modelData = gzdecode(file_get_contents("php://input"));

global $auth;
!$auth->isAuthed() && Server::_404();

$model = new ModelManager;
$model->handleSave();
?>