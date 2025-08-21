<?php
class Sitelog {
    private static $log = "/api/private/core/sitelog.txt";
    public static function add($text) {
        $file = fopen($_SERVER["DOCUMENT_ROOT"].self::$log, "a");
        fwrite($file, $text." | ".date("Y-m-d h:i:sa").PHP_EOL);
        fclose($file);
    }
}
?>