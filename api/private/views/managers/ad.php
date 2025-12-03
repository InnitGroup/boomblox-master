<?php
class AdManager {
    private $allowedFileTypes = ["png", "jpg", "jpeg"];
    public function handleUpload($contentId, $data, $content) {
        global $db; 
        $type = $data->Type;

        if (!isset($_FILES["texture"])) {
            return (object)["Error" => "Texture missing."];
        }

        $file = $_FILES["texture"];
        $targetDirectory = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t3/";
        #$targetFile = 
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

        $height = $imageDimensions[0];
        $width = $imageDimensions[1];

        switch ($type) {
            case "Rectangle":
                if ($height !== 250 || $width !== )
                break;
            case "Skyscraper":
                break;
            case "Banner":
                break;
        }
        if ($type == "Shirt" || $type == "Pants") {
            if ($height !== 585 || $width !== 559) {
                return (object)["Error" => "Texture must be 585x559."];
            }
        }

        $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName) VALUES ('catalog', :catalogType, :creatorId, :creatorName, :itemName)";
        $creatorId = ROBLOSECURITY::match($_COOKIE["BROBLOSECURITY"]);
        $creatorName = $db->getUserById($creatorId);
        $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
        
        $db->execute($stmt, [":catalogType" => $type, ":creatorId" => $creatorId, ":creatorName" => $creatorName, ":itemName" => $fileName]);
        $id = $db->singleton()->lastInsertId();

        $filePath = $targetDirectory . (string)$id . "." . $fileType;
        if (!move_uploaded_file($file["tmp_name"], $targetDirectory . (string)$id . "." . $fileType)) {
            return (object)["Error" => "Error uploading file."];
        }

        $user = new User($creatorId);
        $user->giveItem($id);

        header("Location: /My/Character.aspx?AttireTypeID=".$contentId);
        exit;
    }

    public function __construct() {
        if (Server::isPost()) {
            echo 1;
        }
    }
}
?>