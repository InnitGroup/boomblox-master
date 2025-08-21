<?php
#made: 02/14/2025 @marsoc
#last edit: 02/14/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

#Server::ipLock();
!isset($_GET["userId"]) || $_GET["userId"] == "" && Server::_404();
header('Content-Type: application/xml; charset=utf-8');


$user = new User((int)$_GET["userId"]);
$charapp = $user->getCharacter();
?>

<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
    <External>null</External>
    <External>nil</External>
    <Item class="BodyColors" referent="RBX0">
        <Properties>
            <int name="HeadColor"><?=$charapp["headColor"]?></int>
            <int name="LeftArmColor"><?=$charapp["laColor"]?></int>
            <int name="LeftLegColor"><?=$charapp["llColor"]?></int>
            <string name="Name">Body Colors</string>
            <int name="RightArmColor"><?=$charapp["raColor"]?></int>
            <int name="RightLegColor"><?=$charapp["rlColor"]?></int>
            <int name="TorsoColor"><?=$charapp["torsoColor"]?></int>
            <bool name="archivable">true</bool>
        </Properties>
    </Item>
</roblox>