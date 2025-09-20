<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

exit;
$stmt = "SELECT * FROM items WHERE `itemType`='catalog' AND `catalogType`='Pants' AND `fileName` != ''";
$result = $db->execute($stmt);
if ($result->rowCount() > 0) {
    $shirts = $result->fetchAll(PDO::FETCH_ASSOC);
    $shirtsA = 0;
    foreach ($shirts as $shirt) {
        $shirtsA += 1;
        $file = $_SERVER["DOCUMENT_ROOT"]."/content/shirtsToMigrate/".$shirt["fileName"].".png";
        if (file_exists($file)) {
            $contents = '<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="Pants" referent="RBX0">
		<Properties>
			<string name="Name">Pants</string>
			<Content name="PantsTemplate"><url>http://'.domain.'/content/'.$shirt["itemId"].'_1.png</url></Content>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>';
            $newFile = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/migratedPants/".$shirt["itemId"], $contents);
            $shirtFile = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/content/migratedPants/".$shirt["itemId"]."_1.png", file_get_contents($file));
        }
    }
}
?>