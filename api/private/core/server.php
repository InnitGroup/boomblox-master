<?php
class Server {
    private static $baseUrl = "http://roblox.com/";
    private static $ipTable = array("103.60.12.84");
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
        return in_array(self::getIP(), ["::1", "127.0.0.1", "103.60.12.84"]);
    }
    public static function getServerIP() {
        return self::$ipTable[0];
    }
    public static function currentClientMd5() {
        return "ab8de569917eb6cd25958ef28422aa87";
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
        global $auth;
        if (!$auth->isAuthed()) {
            header("Location: /");
            exit;
        }

        $ext = "";
        $aspxEnabled == true && $ext .= "aspx"; 
        $aspxEnabled == false && $ext .= "php";
        header("HTTP/1.1 404 Not Found");
        header("Location: /Error/Default.".$ext);
        exit; //
    }
    public static function _s404() {
        PageBuilder::addComponent("404", "regular");
        exit;
    }
    public static function _self() {
        $uri = $_SERVER["PHP_SELF"];
        $uri = str_replace(".php", ".aspx", $uri);
        echo '<script>window.location.href = "'.$uri.'";</script>';
    }
    public static function _root() {
        header("Location: /");
        exit;
    }
    public static function _af404() {
        PageBuilder::addComponent("404", "adminfind");
        exit;
    }
    public static function getIP() {
        $ipVariable = $_SERVER['REMOTE_ADDR'];
        if ($ipVariable == "::1") {
            $ipVariable = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ipVariable;
    }

    public static function ipLock() {
        $ip = self::getIP();
        
        if (!in_array($ip ,self::$ipTable)) {
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
            exit;
        }
    }

    public static function lockAPI() {
        $headers = getallheaders();
        $from = $headers["From"];
        if ($from !== "siteApi") {
            header("Location: /404.aspx");
            exit;
        }
    }

    public static function pageRestrictorB($items,$limit,$page) {
        if (ceil($items->rowCount() / $limit) < $page || $page < 1) {
            if ($page == 1 && $items->rowCount() == 0) {
                #$GLOBALS["pageEx"] = "No items found.";
            } else {
                header("Location: 404.aspx");
                exit;
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