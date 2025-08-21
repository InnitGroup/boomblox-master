<?php
global $db, $user;
$assets = [];
$stmt = "SELECT * FROM items WHERE `status` = 'pending' AND `catalogType` IN ('Shirt', 'Pants', 'T-Shirt', 'Decal') LIMIT 15";
$result = $db->execute($stmt);
if ($result->rowCount() > 0) {
    $fetched = $result->fetchAll(PDO::FETCH_ASSOC);
    $assets = $fetched;
}

if (Server::isPost()) {
    if ($user->hasPerms(3)) {
        foreach ($_POST as $assetId => $verdict) {
            switch ($verdict) {
                case "OK":
                    Admin::acceptAsset($assetId);
                    break;
                case "Block":
                    Admin::blockAsset($assetId);
                    break;
                default;
            }
        }
        header("Location: /Admi/Moderation/AssetReview.aspx");
    }
}
?>

<form name="aspnetForm" method="post">
    <div id="AssetPanel">
        <div id="Details">
            <span><b>Items in Queue: </b> <?=count($assets)?></span>
            <?=PageBuilder::addComponent("admin", "assetupdate")?>
        </div>
        <div id="AssetTableContainer">
            <table id="AssetTable">
                <tbody>
                    <?php 
                    if (!empty($assets)) {
                        foreach ($assets as $key => $asset) {
                            $name = $asset["itemName"];
                            $texture = "/cdn/t2/unavail-420x230.png";

                            if ($file = File::getImageType($_SERVER["DOCUMENT_ROOT"]."/cdn/t3/".$asset["itemId"])) {
                                if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/cdn/t3/".$asset["itemId"].".".$file["Extension"])) {
                                    $texture = "/cdn/t3/".$asset["itemId"].".".$file["Extension"];
                                }
                            }
                            
                            $id = $asset["itemId"];
                            PageBuilder::addComponent("admin", "asset", compact("name", "texture", "key", "id"));
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="Details">
            <?=PageBuilder::addComponent("admin", "assetupdate")?>
        </div>
    </div>
</form>