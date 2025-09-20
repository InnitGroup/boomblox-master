<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $auth;
!$auth->isAuthed() && Server::_404();

if (isset($_POST['ChoosePublishContentButton'])) {
    $model = new ModelManager;

    $choice = $_POST['ChoosePublishContentButton'];
    switch ($choice) {
        case 'ChoosePublishContentButton':
            $model->loadSave();
            break;
        case 'ChoosePublishContentModificationButton':
            $model->loadUpdate();
            break;
        default:
            $model->loadSave();
            break;
    }
}

?>