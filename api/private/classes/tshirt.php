<?php
class Tshirt {
    public static function render($tshirtId, $upload = true) {
        $backgroundPath = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t2/tshirt-template.png";
        $overlayPath = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t3/$tshirtId.png";
        $outputPath = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t7/$tshirtId.png";

        $background = imagecreatefrompng($backgroundPath);
        imagealphablending($background, true);
        imagesavealpha($background, true); 

        $overlay = @imagecreatefrompng($overlayPath);

        $bgWidth = imagesx($background);
        $bgHeight = imagesy($background);

        $overlayWidth = imagesx($overlay);
        $overlayHeight = imagesy($overlay);

        $scale = 0.5;
        $newOverlayWidth = (int)($bgWidth * $scale);
        $newOverlayHeight = (int)(($newOverlayWidth / $overlayWidth) * $overlayHeight);

        $resizedOverlay = imagecreatetruecolor($newOverlayWidth, $newOverlayHeight);
        imagealphablending($resizedOverlay, false);
        imagesavealpha($resizedOverlay, true);
        imagecopyresampled(
            $resizedOverlay, $overlay,
            0, 0, 0, 0,
            $newOverlayWidth, $newOverlayHeight,
            $overlayWidth, $overlayHeight
        );

        $destX = (int)(($bgWidth - $newOverlayWidth) / 2);
        $destY = (int)(($bgHeight - $newOverlayHeight) / 2);

        imagecopy($background, $resizedOverlay, $destX, $destY, 0, 0, $newOverlayWidth, $newOverlayHeight);
        if ($upload) {
            imagepng($background, $outputPath, 6);
        } else {
            imagepng($background);
        }
        

        imagedestroy($background);
        imagedestroy($overlay);
        imagedestroy($resizedOverlay);
    }
}
?>