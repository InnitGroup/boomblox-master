<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

exit;

$givenKey = $_GET["Key"];
$askedKey = "BOOMERRORGOBOOMHAHAHAHHA" . pi() * $user->getUserId() + 1;

if ($givenKey == $askedKey) {
    #$user->giveItem(2163);
}

header("Location: /Item.aspx?ID=2163");
exit;

?>