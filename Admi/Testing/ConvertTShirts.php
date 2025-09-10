<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder;

exit;
$stmt = "SELECT * FROM items WHERE `itemType`='catalog' AND `catalogType`='T-Shirt' AND `fileName` != ''";
$result = $db->execute($stmt);
if ($result->rowCount() > 0) {
    $shirts = $result->fetchAll(PDO::FETCH_ASSOC);
    $shirtsA = 0;
    foreach ($shirts as $shirt) {
        $shirtsA += 1;
        $file = $_SERVER["DOCUMENT_ROOT"]."/content/tshirtsToMigrate/".$shirt["fileName"].".png";
        if (file_exists($file)) {
            $contents = '<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://bmblox.xyz/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="ShirtGraphic" referent="RBX0">
		<Properties>
			<Content name="Graphic"><url>http://'.domain.'/content/'.$shirt["itemId"].'_1.png</url></Content>
			<string name="Name">Shirt Graphic</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>';
            $newFile = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/migratedShirts/".$shirt["itemId"], $contents);
            $shirtFile = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/migratedShirts/".$shirt["itemId"]."_1.png", file_get_contents($file));
            unlink($file);
        }
    }
}
?>