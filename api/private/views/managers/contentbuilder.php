<?php

class ContentBuilderManager {
    private $allowedFileTypes = ["png", "jpg", "jpeg"];
    public function handleUpload($contentId, $data, $content) {
        global $db, $user; 
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

        if ($type == "Shirt" || $type == "Pants") {
            if ($height !== 585 || $width !== 559) {
                return (object)["Error" => "Texture must be 585x559."];
            }
        } else {
            if ($height > 2000 || $width > 2000) {
                return (object)["Error" => "{$type} cannot be larger than 2000x2000."];
            }
        }

        $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName, lastUpdate) VALUES ('catalog', :catalogType, :creatorId, :creatorName, :itemName, :lastUpdate)";
        $date = date("Y-m-d H:i:s");
        $creatorId = $user->getUserId();
        $creatorName = $db->getUserById($creatorId);
        $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
        
        if (strlen($fileName) > 75) {
            $fileName = substr($fileName, 0, 75);
        }

        $db->execute($stmt, [
            ":catalogType" => "Image", 
            ":creatorId" => $creatorId, 
            ":creatorName" => $creatorName, 
            ":itemName" => Helper::debugString($fileName),
            ":lastUpdate" => $date
        ]);

        $id = $db->lastInsertId("items");
        $filePath = $targetDirectory . (string)$id . "." . $fileType;
        if (!move_uploaded_file($file["tmp_name"], $targetDirectory . (string)$id . "." . $fileType)) {
            return (object)["Error" => "Error uploading file."];
        }

        $user->giveItem($id);

        $stmt = "INSERT INTO items (itemType, catalogType, creatorId, creatorName, itemName, lastUpdate) VALUES ('catalog', :catalogType, :creatorId, :creatorName, :itemName, :lastUpdate)";

        $db->execute($stmt, [
            ":catalogType" => $type, 
            ":creatorId" => $creatorId, 
            ":creatorName" => $creatorName, 
            ":itemName" => Helper::debugString($fileName),
            ":lastUpdate" => $date
        ]);
        
        $file = new File("/api/private/xml/$type.xml", ["1" => "http://".domain."/asset/?id=$id"]);
        $file = $file->handle();
        $xmlId = $db->lastInsertId("items");
        file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/content/$xmlId", $file);

        header("Location: /My/Character.aspx?AttireTypeID=" . $contentId);
        exit;
    }
}

?>