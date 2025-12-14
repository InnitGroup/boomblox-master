<?php
# for ad generation on-site
class Ad {

    # generates an ad
    public static function generateAd($size) {
        $sizes = ["160x600", "728x90", "300x250"];

        if (in_array($size, $sizes)) {
            PageBuilder::addComponent("ad", $size);
        }
    }

    public static function fallbackAds($size) {
        $ads = [
            "160x600" => [
                "/images/ads/InviteGiftSkyscraper.png"
            ],
            "728x90" => [
                "/images/ads/ROtrisRectangle.png"
            ],
            "300x250" => [
                "/images/ads/ROtrisSquare.png"
            ]
        ];

        return (object)["isFallback" => true, "src" => $ads[$size][array_rand($ads[$size])]];
    }

    # ad generating algorithm for user ads
    public static function algorithm($size) {
        global $db;

        $stmt = "SELECT * FROM ads WHERE `last_bid` > 0 AND `status` = 'running' AND `size` = :_size ORDER BY `last_bid` DESC";
        $result = $db->execute($stmt, [":_size" => $size]);
        if ($result->rowCount() == 0) {
            return self::fallbackAds($size);
        }

        $ads = $result->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
        foreach ($ads as $ad) {
            $total += $ad["last_bid"];
        }

        $rand = mt_rand() / mt_getrandmax() * $total;

        foreach ($ads as $ad) {
            $rand -= $ad["last_bid"];
            if ($rand <= 0) {
                $userAd = new UserAd($ad["id"]);
                return $userAd;
            }
        }

        $userAd = new UserAd(end($ads)["id"]);
        return $userAd;
    }
}
?>