<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user, $db;
!$auth->isAuthed() && Server::_404();

$userId = $user->getUserId();
if (isset($_GET["UserID"])) $userId = $_GET["UserID"];

if (!$db->userExists($userId)) Server::_404();

$stmt = "SELECT * FROM `cdn` WHERE `size`='500x500' AND `format`='PNG' AND `createdBy`=:userId ORDER BY `createdAt` ASC";
$result = $db->execute($stmt, [":userId" => $userId]);
echo $db->getUserById($userId) . "'s renders: " . $result->rowCount() . "<br><br>";

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<img style='height:100px' title='" . $row["createdAt"] . "' src='https://t2.xoblog.dev/" . $row["hash"] . "'>";
}

/*
for ($i = 1; $i <= 157; $i++) {
    $avatar = new Avatar($i);
    $render = $avatar->GetThumbnail(500, 500, "PNG");
    echo "<a href='/User.aspx?ID=$i'><img src='$render' style='height:100px'></a>";
}
    */
?>