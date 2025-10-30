<?php

# managing the asset redirect page
class AssetRedirect {

    # roblosecurity cookie of the asset redirect temporary account
    private array $roblosecurity = [
        roblosecurity
    ];

    # main constructor
    public function __construct($assetId, $version = 1) {
        if (!empty($assetId) && $assetId !== 0) {
            $this->redirect($assetId, $version);
        }
    }

    # curls the asset api
    public function curl($assetId, $version = 1) {
        $roblosecurity = base64_decode($this->roblosecurity[0]);

        if ($this->isCached($assetId)) {
            $asset = $_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId;
            return file_get_contents($asset);
        }

        $curl = curl_init("https://assetdelivery.roblox.com/v1/asset/?id=$assetId&version=$version");
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

    # checks if an asset is cached
    public function isCached($assetId) {
        return file_exists($_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId);
    }

    # caches an asset
    public function cache($assetId, $asset) {
        return file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/roblox/" . $assetId, $asset);
    }

    # serves the asset redirect
    public function redirect($assetId, $version) {
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

                exit(file_get_contents($location));
            }
        }

        $asset = $this->curl($assetId, $version);
        if (str_starts_with($asset, '{"errors"')) {
            header('Content-Type: application/json; charset=utf-8');
            echo $asset;
            exit;
        }

        if(str_starts_with($asset, '�PNG')) {
            header('Content-Type: image/png');
            echo $asset;
            exit;
        }

        echo $asset;
        exit;
    }
}
?>