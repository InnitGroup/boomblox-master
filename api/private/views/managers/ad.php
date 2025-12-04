<?php
class AdManager {
    private $allowedFileTypes = ["png", "jpg", "jpeg"];
    public function handleUpload() {
        global $db; 

        if (!isset($_FILES['ctl00$cphRoblox$adFile'])) {
            return (object)["Error" => "Texture missing."];
        }

        $file = $_FILES['ctl00$cphRoblox$adFile'];
        $targetDirectory = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t4/";
        $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        if (File::isWebp($file["tmp_name"])) {
            return (object)["Error" => "Illegal file type: .png/.jpg, only!"];
        }

        if (!in_array($fileType, $this->allowedFileTypes)) {
            return (object)["Error" => "Illegal file type: .png/.jpg, only!"];
        }

        $imageDimensions = getimagesize($file["tmp_name"]);

        if (!$imageDimensions) {
            return (object)["Error" => "Faulty image file."];
        }

        $height = $imageDimensions[1];
        $width = $imageDimensions[0];

        $adType = "N/A";

        if ($width == 300 && $height == 250) {
            $adType = "Rectangle";
        } elseif ($width == 160 && $height == 600) {
            $adType = "Skyscraper";
        } elseif ($width == 728 && $height == 90) {
            $adType = "Banner";
        } else {
            echo $width . "x" . $height;
            return (object)["Error" => "Texture must be either 300x250, 160x600 or 728x90."];
        }

        $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
        $md5 = md5(file_get_contents($file["tmp_name"]));
        $filePath = $targetDirectory . (string)$md5;
        $assetId = (int)$_GET["targetID"];

        global $user;
        UserAd::new($_POST['ctl00$cphRoblox$adName'], $user, $width . "x" . $height, $md5, $assetId);

        if (!move_uploaded_file($file["tmp_name"], $filePath)) {
            return (object)["Error" => "Error uploading file."];
        }

        header("Location: /My/AdInventory.aspx");
        exit;
    }

    public function __construct() {
        
    }
}
?>