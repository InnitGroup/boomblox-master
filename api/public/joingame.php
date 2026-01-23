<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;
!isset($_GET["md5"]) && Server::_404();

$md5 = htmlspecialchars($_GET["md5"]);
$currentMd5 = Server::currentClientMd5();

if (strlen($md5) > 33) {
    if ($auth->isAuthed()) {
        exit(Discord::sendWebhookMessage("anticheat", "-# user: `{$user->getUsername()}` tried spoofing their md5 to `{$md5}`"));
    }
    
    #exit(Discord::sendWebhookMessage("anticheat", "-# an anonymous user tried spoofing their md5 to `{$md5}`"));
}

$user->setClientMd5($md5);
if ($md5 == $currentMd5) {
    exit(Discord::sendWebhookMessage("anticheat", "-# user: `{$user->getUsername()}`, client md5: `{$md5}`"));
}

exit(Discord::sendWebhookMessage("anticheat", "-# user: `{$user->getUsername()}` has an old or deceived client md5: `{$md5}`"));

exit;
?>