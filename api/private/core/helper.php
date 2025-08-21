<?php
class Helper {
    public static function directData($assoc, &$array) {
        foreach ($array as $data) {
            if (isset($assoc[$data])) {
                $array[$data] = $assoc[$data];
            }
        }
    }
    public static function itemType($id) {
        $types = [
            1 => "NA",
            2 => "T-Shirt",
            4 => "Head",
            8 => "Hat",
            9 => "Place",
            10 => "Model",
            11 => "Shirt",
            12 => "Pants",
            13 => "Decal"
        ];

        $contentTypes = [
            1 => "NA",
            2 => "T-Shirt",
            11 => "Shirt",
            12 => "Pants",
            13 => "Decal"
        ];

        return (object)["Type" => $types[$id], "IsContent" => $contentTypes[$id] ?? false] ?? null;
    }
    public static function typeId($type) {
        $types = [
            "T-Shirt" => 2,
            "Hat" => 8,
            "Shirt" => 11,
            "Pants" => 12
        ];
        return $types[$type];
    }
    public static function makePlural(string $string) {
        if (str_ends_with($string, "s")) {
            return $string;
        } else {
            return $string."s";
        }
    }
    public static function sign($script) {
        $key = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/api/private/lua/PrivateKey.pem");
        $signature = "";
        openssl_sign($script, $signature, $key, OPENSSL_ALGO_SHA1);
        return base64_encode($signature);
    }
    public static function contains($string, $contains) {
        $sContains = implode('', $contains);
        return strpbrk($string,$sContains) !== false && true || strpbrk($string,$sContains);
    }
    public static function validUsername($username) {
        return preg_match("/^[A-Za-z0-9]+$/",$username);
    }
    public static function times($value) {
        if ($value == 1) {
            return number_format($value)." time";
        } else {
            return number_format($value)." times";
        }
    }
    public static function timeAgo($timestamp) {
        $current_time = time();
        $time_diff = $current_time - strtotime($timestamp);
    
        $seconds = $time_diff;
        $minutes = round($time_diff / 60);
        $hours = round($time_diff / 3600);
        $days = round($time_diff / 86400);
        $weeks = round($time_diff / 604800);
        $months = round($time_diff / 2629440);
        $years = round($time_diff / 31553280);

        if ($seconds <= 60) {
            return "$seconds second" . ($seconds > 1 ? "s" : "") . " ago";
        } elseif ($minutes <= 60) {
            return "$minutes minute" . ($minutes > 1 ? "s" : "") . " ago";
        } elseif ($hours <= 24) {
            return "$hours hour" . ($hours > 1 ? "s" : "") . " ago";
        } elseif ($days <= 7) {
            return "$days day" . ($days > 1 ? "s" : "") . " ago";
        } elseif ($weeks <= 4.3) {
            return "$weeks week" . ($weeks > 1 ? "s" : "") . " ago";
        } elseif ($months <= 12) {
            return "$months month" . ($months > 1 ? "s" : "") . " ago";
        } else {
            return "$years year" . ($years > 1 ? "s" : "") . " ago";
        }
    }

    public static function is_even(int $number): bool {
        return $number % 2 == 0;
    }

    public static function bTimeAgo($timestamp) {
        $now = new DateTime();
        $diff = $now->diff($timestamp);
        return $diff->days;
    }
    public static function dimensions($width,$height) {
        return (int)$width."x".(int)$height;
    }
    //https://stackoverflow.com/questions/21671179/how-to-generate-a-new-guid
    public static function guid() {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    public static $brickColors = array(
        1=>'242, 243, 243',#white
        #2=>'161, 165, 162',#grey
        3=>'249, 233, 153',#light yellow
        5=>'215, 197, 154',#brick yellow
        9=>'232, 186, 200',#light reddish violet
        11=>'128, 187, 219',#pastel blue
        18=>'204, 142, 105',#nougat
        21=>'196, 40, 28',#bright red
        23=>'13, 105, 172',#bright blue
        24=>'245, 205, 48',#bright yellow
        26=>'27, 42, 53',#black
        28=>'40, 127, 71',#dark green
        29=>'161, 196, 140',#medium green
        37=>'75, 151, 75',#bright green
        38=>'160, 95, 53',#dark orange
        45=>'180, 210, 228',#light blue
        101=>'218, 134, 122',#medium red
        102=>'110, 153, 202',#medium blue
        104=>'107, 50, 124',#bright violet
        105=>'226, 155, 64',#br yellowish orange
        106=>'218, 133, 65',#bright orange
        107=>'0, 143, 156',#bright bluish green
        119=>'164, 189, 71',#br yellowish green
        125=>'234, 184, 146',#light orange
        135=>'116, 134, 157',#sand blue
        141=>'39, 70, 45',#earth green
        151=>'120, 144, 130',#sand green
        153=>'149, 121, 119',#sand red
        192=>'105, 64, 40',#reddish brown
        194=>'163, 162, 165',#medium stone grey
        199=>'99, 95, 98',#dark stone grey
        208=>'229, 228, 223',#light stone grey
        217=>'124, 92, 70'#brown
    );
    public static function rgbToBrick($rgb) {
        while ($color = current(self::$brickColors)) {
            if ($color == $rgb) {
                return key(self::$brickColors);
            }
            next(self::$brickColors);
        }
    }
    public static function isset($value) {
        return isset($value) && !empty($value);
    }
    public static function validateCheckbox(string $data) {
        return isset($_POST[$data]) && $_POST[$data] === 'on';
    }

    public static function validateInteger(int $data) {
        return isset($_POST[$data]) ? (int) $_POST[$data] : 0;
    }

    public static function timeFormat($timestamp, int $type = 1) {
        $type = gettype($timestamp);
        if ($type == "string") {
            $timestamp = new DateTime($timestamp);
        }

        return $timestamp->format("n/j/Y h:i:s A");
    }

    public static function cphIdentifier($key) {
        return str_pad($key, 2, '0', STR_PAD_LEFT);
    }
}
?>