<?php
class IP {
    public static function get() {
        $ipVariable = $_SERVER['REMOTE_ADDR'];
        if ($ipVariable == "::1") {
            $ipVariable = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ipVariable;
    }

    public static function hash($ip) {
        $privateKey = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/api/private/lua/PrivateKey.pem");
        $signed = openssl_sign($ip, $signature, $privateKey, OPENSSL_ALGO_SHA1);
        $hashed = password_hash($signed, PASSWORD_BCRYPT);
        return $hashed;
    }

    public static function whitelist(int $userId) {
        $ip = self::hash(self::get());

        global $db;
        $stmt = "SELECT * FROM whitelist WHERE ip=:ip";
        $result = $db->execute($stmt, [":ip" => $ip]);

        if ($result->rowCount() > 0) {
            $stmt = "UPDATE whitelist SET whitelisted=1 WHERE ip=:ip";
            return $db->execute($stmt, [":ip" => $ip]);
        }

        $stmt = "INSERT INTO whitelist (userId, ip) VALUES (:userId, :ip)";
        return $db->execute($stmt, [
            ":userId" => $userId,
            ":ip" => $ip
        ]);
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