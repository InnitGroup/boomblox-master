<?php
class Controller {
    public static function requireAuth() {
        !isset($_COOKIE["BROBLOSECURITY"]) && header("HTTP/1.1 404 Not Found");
    }
}
?>