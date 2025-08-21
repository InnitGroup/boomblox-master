<?php
class Server {
    private static $baseUrl = "http://roblox.com/";
    private static $ipTable = array("104.219.236.150");
    private static $rccUrl = "http://localhost:43241/";
    private static $rccPort = 43241;
    public static function isPost() {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }
    public static function getBaseUrl() {
        return self::$baseUrl;
    }
    public static function getIE() {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE (\d+\.\d+);/', $agent, $matches)) {
            #https://www.php.net/manual/en/language.types.object.php#language.types.object.casting
            return $matches[1];
        }else {
            return false;
        }
    }
    public static function isLocal() {
        return in_array($_SERVER["REMOTE_ADDR"], ["::1", "127.0.0.1", "104.219.236.150"]);
    }
    public static function isIE7() {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/MSIE (\d+\.\d+);/', $agent, $matches)) {
            #https://www.php.net/manual/en/language.types.object.php#language.types.object.casting
            return $matches[1] == "7.0";
        }else {
            return false;
        }
    }
    public static function isClient() {
        $agent = $_SERVER["HTTP_USER_AGENT"];
        return $agent == "Roblox/WinInet";
    }
    public static function _404($aspxEnabled = true) {
        $ext = "";
        $aspxEnabled == true && $ext .= "aspx"; 
        $aspxEnabled == false && $ext .= "php";
        header("Location: /Error/Default.".$ext);
    }
    public static function _s404() {
        PageBuilder::addComponent("404", "regular");
        exit;
    }
    public static function _af404() {
        PageBuilder::addComponent("404", "adminfind");
        exit;
    }
    public static function ipLock() {
        $ipVariable = $_SERVER['REMOTE_ADDR'];
        if ($ipVariable == "::1") {
            $ipVariable = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        
        if (!in_array($ipVariable ,self::$ipTable)) {
            self::_404();
        }
    }
    public static function marLock() {
        global $user;
        if ($user->getUserId() != 3) {
            self::_404();
        }
    }
    public static function pageRestrictor($items,$limit,$page) {
        if (ceil($items->rowCount() / $limit) < $page || $page < 1) { #ceil()->rowCount() / 20) < $p || $p < 1
            header("Location: /Error/Default.aspx");
        }
    }

    public static function lockAPI() {
        $headers = getallheaders();
        $from = $headers["From"];
        if ($from !== "siteApi") {
            header("Location: /404.aspx");
        }
    }

    public static function pageRestrictorB($items,$limit,$page) {
        if (ceil($items->rowCount() / $limit) < $page || $page < 1) {
            if ($page == 1 && $items->rowCount() == 0) {
                #$GLOBALS["pageEx"] = "No items found.";
            } else {
                header("Location: 404.aspx");
            }
        }
    }

    public static function callAPI($apiUrl) {
        return file_get_contents($apiUrl);
    }

    public static function getRccAddress() {
        return self::$rccUrl;
    }
    public static function getRccPort() {
        return self::$rccPort;
    }
}
?>