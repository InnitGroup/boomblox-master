<?php
class Deployment {
    private $deployData = [];
    private $deployHistory = "/cdn/t0/DeployHistory.txt";
    public function __construct($deployType, $appType, $clientPath) {
        $this->deployData["type"] = $deployType;
        $this->deployData["appType"] = $appType;
        $this->deployData["client"] = $clientPath;
    }
    public function generateHash() {
        return sprintf('%04x%04x%04x%04x', mt_rand(0, 65535),mt_rand(0, 65535),mt_rand(0, 65535),mt_rand(0, 65535));
    }
    public function prep() {
        $hash = substr(md5_file($this->deployData["client"]), -16);
        move_uploaded_file($this->deployData["client"], $_SERVER["DOCUMENT_ROOT"] . "/cdn/t0/version-$hash.zip");
        return $hash;
    }
    public function deploy($hash) {
        global $db;
        $file = fopen($_SERVER['DOCUMENT_ROOT'].$this->deployHistory, "a");
        $time = new DateTime();

        $stmt = "SELECT * FROM deploy WHERE versionHash=:versionHash";
        $result = $db->execute($stmt, [":versionHash" => $hash]);
        if ($result->rowCount() > 0) {return false;}
        
        $deployText = "New ".htmlspecialchars($this->deployData["appType"])." version-".$hash." at ".$time->format("n/j/o h:i:s A")."... Done!".PHP_EOL;
        fwrite($file, $deployText);
        fclose($file);

        $stmt = "INSERT INTO deploy (`deployType`, `appType`, `versionHash`) VALUES (:deployType, :appType, :versionHash)";
        return $db->execute($stmt, [":deployType" => htmlspecialchars($this->deployData["type"]), ":appType" => htmlspecialchars($this->deployData["appType"]), ":versionHash" => $hash]);
    }
    public static function push($hash) {
        $file = fopen($_SERVER["DOCUMENT_ROOT"] . "/version.txt", "w");
        fwrite($file, $hash);
        fclose($file);
    }
}
?>