<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $user, $auth;

#!$auth->isAuthed() && Server::_404();

$hashes = [
    "AnticheatA" => "d6c7c820f52ab1089ab463afd2f2b8bb7fee9581cdcec3acec709e8cf1ae5039",
    "fmodex.dll" => "da0db97d9236710f8c0d44dbd15dc8630b70b45495878fe8081014989787964f",
    "rgdx.dll" => "82f155241908b238224dc1a44b724755f82af1ff3dc3a976f33288ef515e1c86",
    "rggl.dll" => "4fad5f82d15b96bcc65bc022e457de5cebfe88bc866f53329e8071d8e44a5496",
    "rgmain.dll" => "33303899fefbc38e9ad8774417f81a432ec4d0a432fd1ff95c98375e37d34b3c",
    "rgpar.dll" => "eaa4d88e78c7f8193cdf920d9e3004e8791e4a16b38dd55986dee73f02af5fb2",
    "RobloxInstall.dll" => "ffe76f466744b2e3b1d92a8964580c2368a6a928c79fc360a53bb727ffca86b6",
    "RobloxLauncher.dll" => "16f31fe344e21d0d117fa041cc8b8770eba4658a4bd6679a26afbda5aa64248a",
    "SciLexer.dll" => "17112ed0cb094931027ad6f8e1523fcfe3dcd4abd5f7f8628d77679a550d2147",
    "tbb.dll" => "21a48a572bb9d3e136cdb40e33f8717bf38e08ccde9ed07c545c97e911470157"
];

$_SERVER["HTTP_USER_AGENT"] !== "Boomblox/1.0" && Server::_404();
!isset($_GET["dll"]) && Server::_404();

$dll = $_GET["dll"];

!isset($hashes[$dll]) && Server::_404();
#Discord::sendWebhookMessage("weird", "[testing] searching for dll...: $dll");
echo $hashes[$dll];

exit;
?>