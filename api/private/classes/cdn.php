<?php
class CDN {
    private static $cdn = "t2";
    public static function correspondingRenders($original,$altHash,$userId,$nWidth,$nHeight) {
        global $db;
        $info = getimagesize($original);
        $type = $info['mime'];
        $size = $nWidth."x".$nHeight;

        switch ($type) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($original);
                $format = "JPG";
                break;
            case 'image/png':
                $image = imagecreatefrompng($original);
                $format = "PNG";
                break;
        }

        list($oWidth, $oHeight) = $info;
        $resized = imagecreatetruecolor($nWidth, $nHeight);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $nWidth, $nHeight, $oWidth, $oHeight);

        ob_start();
        switch ($type) {
            case 'image/jpeg':
                imagejpeg($resized);
                break;
            case 'image/png':
                imagepng($resized);
                break;
        }
        $data = ob_get_contents();
        ob_end_clean();

        $hash = md5($data);
        $sql = "INSERT INTO cdn (`hash`, `altHash`, `size`, `format`, `location`, `createdBy`) VALUES ('".$hash."', '".$altHash."', '".$size."', '".$format."','".self::$cdn."',".$userId.")";
        $db->execute($sql);
        $output = $_SERVER['DOCUMENT_ROOT']."/cdn/".self::$cdn."/".$hash;
        file_put_contents($output, $data);
        return $hash;
    }
    public static function hashExists($altHash,$size,$format, &$hasError) {
        global $db;
        $sql = "SELECT * FROM cdn WHERE `altHash`='".$altHash."' AND `size`='".$size."' AND `format`='".$format."'";
        $result = $db->execute($sql);
        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if ($result["error"] == 0) {
                return "/cdn/".$result["location"]."/".$result["hash"];;
            } else {
                $hasError = 1;
                return false;
            }
        }
    }
    public static function getCommonCDN() {
        return self::$cdn;
    }
}
?>