<?php
#made: 04/05/2025 @marsoc
#last edit: 04/05/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
#Server::lockAPI();

$data = file_get_contents("php://input");
$data = json_decode($data, true);
if (!isset($data)) {
    Server::_404();
}

$requestedUser = new UserManager((int)$data["userId"], (int)$data["publicView"], (int)$data["theme"], $data["postData"]);
echo $requestedUser->loadInventoryPane();
?>