<?php
class ModelManager {
    public function handleSave() {
        if (!empty($_POST)) {
            global $db, $user;

            if (isset($_POST['CreationsRepeater$ctl00$CreationSelector'])) {
                exit;
            }

            if ($user->timeSinceLastAsset() < 3) {
                exit;
            }

            $temp = $_SERVER["DOCUMENT_ROOT"] . "/content/temp/{$user->getUserId()}";
            if (!file_exists($temp) || filesize($temp) <= 0) {
                exit;
            }
            
            $name = !empty($_POST['ctl00$cphRoblox$Name']) ? $_POST['ctl00$cphRoblox$Name'] : "Model";
            $description = !empty($_POST['ctl00$cphRoblox$Description']) ? $_POST['ctl00$cphRoblox$Description'] : "Model";
            $publicUse = isset($_POST['ctl00$cphRoblox$PublicUse']);

            if (strlen($name) > 50) {
                $name = substr($name, 0, 50);
            }

            $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName, itemDescription, onsale, lastUpdate)
            VALUES ('catalog', 'Model', :creatorId, :creatorName, :itemName, :itemDescription, :onsale, :lastUpdate)";
            $db->execute($stmt, [
                ":creatorId" => $user->getUserId(),
                ":creatorName" => $user->getUsername(),
                ":itemName" => $name,
                ":itemDescription" => $description,
                ":onsale" => (int)$publicUse,
                ":lastUpdate" => date("Y-m-d H:i:s")
            ]);

            $modelId = $db->lastInsertId("items", "creatorId = {$user->getUserId()} AND catalogType='Model'");
            $model = file_get_contents($temp);

            $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/content/$modelId", "w");
            fwrite($file, $model);
            fclose($file);

            $file = new File("/content/$modelId");
            $file->links();

            $asset = new Asset($modelId);
            $asset->RequestThumbnail(250, 250, "PNG");

            unlink($temp);
            exit;
        }
    }
    public function handleUpdate() {
        global $db, $user;
        if (isset($_POST['CreationsRepeater$ctl00$CreationSelector'])) {
            exit;
        }
    }
    public function loadSave() {
        PageBuilder::addComponent("ide","modelsave");
    }

    public function loadUpdate() {
        PageBuilder::addComponent("ide","modelupdate");
    }
}
?>