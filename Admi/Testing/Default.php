<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db, $User;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

exit;
$participants = [
    "viny",
    "tmr",
    "pwnzor",
    "nox",
    "kainsteronyt",
    "grenbiguy",
    "Zanryth",
    "sharklebanan",
    "Chetoz",
    "G2HJS",
    "1o4xy9i8h9fPwnerv1",
    "Spades",
    "cubp",
    "kainsteronyt",
    "chicken",
    "thereal",
    "jamster",
    "phil",
    "Tixguy211",
    "platos",
    "killeroid7"
];

foreach ($participants as $participant) {
    $participantObj = new User($db->getIdByUser($participant));
    $participantObj->giveItem(2505);
}
?>