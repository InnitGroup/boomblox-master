<?php
class IP {
    private static $signatureKey = [
        "000x00F__ip:"
    ];
    public static function getIP($isDynamic = false) {
        $ip = file_get_contents("https://api.ipify.org");
        if ($isDynamic) {
            $explodedIp = explode(".", $ip);
            $ip = $explodedIp[0].".".$explodedIp[1];
        }
        return $ip;
    }
    public static function getDatabaseIp($ip = null, $isDynamic = false) {
        if (!isset($ip)) {
            $ip = self::getIp($isDynamic);
        }
        
        # using a custom signature key in order to prevent any sort of brute forcing if ips are ever leaked via site database, along with base64 encryption for extra steps
        $ip = self::$signatureKey[0].base64_encode($ip);
        $ip = password_hash($ip, PASSWORD_BCRYPT);
        return $ip;
    }
    public static function decryptIp($ip) {
        $ip = explode(":", $ip);
        $ip = $ip[1];
        $ip = base64_decode($ip);
        return $ip;
    }
    public static function verifyIp($givenIp, $hashedIp) {
        return password_verify(self::$signatureKey[0].$givenIp,$hashedIp);
    }
}
?>