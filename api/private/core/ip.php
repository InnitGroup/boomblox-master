<?php
class IP {
    private static $signatureKey = [
        "000x00F__ip:"
    ];
    /*public static function getIP($isDynamic = false) {
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
    }*/

    public static function get() {
        $ipVariable = $_SERVER['REMOTE_ADDR'];
        if ($ipVariable == "::1") {
            $ipVariable = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ipVariable;
    }

    public static function hash($ip) {
        $hashed = password_hash($ip, PASSWORD_BCRYPT);
        return $hashed;
    }

    public static function sign($ip) {
        $privateKey = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/api/private/lua/PrivateKey.pem");
        $signed = openssl_sign($ip, $signature, $privateKey, OPENSSL_ALGO_SHA1);
        return $signed;
    }

    public static function whitelist(int $userId) {
        $signed = self::sign(self::get());
        $hashed = self::hash($signed);

        global $db;
        $stmt = "SELECT * FROM whitelist WHERE userId=:userId";
        $result = $db->execute($stmt, [":userId" => $userId]);

        if ($result->rowCount() > 0) {
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($signed, $result["ip"])) {
                $stmt = "UPDATE whitelist SET whitelisted=1 WHERE userId=:userId";
                $db->execute($stmt, [":userId" => $userId]);
                return;
            }
        }

        $stmt = "INSERT INTO whitelist (ip, userId) VALUES (:ip, :userId)";
        $db->execute($stmt, [":ip" => $hashed, ":userId" => $userId]);
        return;
    }

    public static function whitelisted($ip) {
        global $db;
        $stmt = "SELECT * FROM whitelist WHERE ip=:ip AND whitelisted=1";
        $ip = self::hash($ip);
        $result = $db->execute($stmt, [":ip" => $ip]);

        return $result->rowCount() > 0;
    }
}
?>