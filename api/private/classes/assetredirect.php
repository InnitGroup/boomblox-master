<?php
class AssetRedirect {
    private array $roblosecurity = [
        roblosecurity
    ];
    public function __construct($assetId) {
        if (!empty($assetId) && $assetId !== 0) {
            $this->redirect($assetId);
        }
    }
    public function curl($assetId) {
        $roblosecurity = base64_decode($this->roblosecurity[0]);

        if ($this->isCached($assetId)) {
            $asset = $_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId;
            return file_get_contents($asset);
        }

        $curl = curl_init("https://assetdelivery.roblox.com/v1/asset/?id=" . $assetId . "&version=1");
        curl_setopt_array($curl, [
            CURLOPT_ENCODING => "",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => "Roblox/WinInet",
            CURLOPT_HTTPHEADER => ["Cookie: .ROBLOSECURITY={$roblosecurity}"],
        ]);

        $asset = curl_exec($curl);
        if (!$this->isCached($assetId) && $asset !== '{"errors":[{"code":0,"message":"Authentication required to access Asset."}]}' && $asset !== '{"errors":[{"code":0,"message":"Request asset was not found"}]}') {
            $this->cache($assetId, $asset);
        }
        return $asset;
    }
    public function isCached($assetId) {
        return file_exists($_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId);
    }
    public function cache($assetId, $asset) {
        return file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId, $asset);
    }

    public function redirect($assetId) {
        global $db;
        $stmt = "SELECT * FROM items WHERE itemId=:itemId";
        $result = $db->execute($stmt, [":itemId" => (int)$assetId]);
        if ($result->rowCount() > 0) {
            $location = "../content/".(int)$assetId;
            if (file_exists($location)) {
                $item = $result->fetch(PDO::FETCH_ASSOC);
                if (!$item["itemType"] == "game") {
                    Server::ipLock();
                }
                echo file_get_contents($location);
            } else {
                $asset = $this->curl($assetId);
                echo $asset;
            }
        } else {
            $asset = $this->curl($assetId);
            echo $asset;
        }
    }
}
?>