<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

exit;
$givenKey = $_GET["Key"];
$askedKey = "SUPERCALIFRAGILISTICEXPIALODOCIOUS" . pi() * $user->getUserId();

if ($givenKey == $askedKey) {
    $user->giveItem(2021);
}

header("Location: /Item.aspx?ID=2021");
exit;

?>