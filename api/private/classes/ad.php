<?php
# for ad generation on-site
class Ad {

    # generates an ad
    public static function generateAd($size) {
        switch ($size) {
            case "160x600":
                PageBuilder::addComponent("ad", "160x600");
            break;
        }
    }
}
?>