<?php

class Crypt {
    private static $keyPath = "/api/private/lua/PrivateKey.pem";
    public static function sign($data) {
        $key = file_get_contents($_SERVER["DOCUMENT_ROOT"] . self::$keyPath);
        openssl_sign($data, $signature, $key, OPENSSL_ALGO_SHA1);
        return $signature;
    }

    public static function scriptSign($data) {
        $signature = self::sign($data);
        return sprintf("%%%s%%%s", base64_encode($signature), $data);
    }

    public static function alternativeScriptSign($data) {
        ob_start();
        echo $data;
        $data = ob_get_clean();
        
        $signature = base64_encode(self::sign("\r\n" . $data));
        return "%". $signature . "%\r\n" . $data;
    }
}

?>