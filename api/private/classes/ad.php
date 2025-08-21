<?php
class Ad {
    public static function generateAd($size) {
        switch ($size) {
            case "160x600":
                $rand = mt_rand(1,3);
                $adName = "googleads";
                include_once($_SERVER["DOCUMENT_ROOT"]."/aaa/components/ad.php");
                break;
        }
    }
}
?>