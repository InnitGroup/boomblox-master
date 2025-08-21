<?php
#https://www.php.net/manual/en/function.spl-autoload-register.php

require_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/core/main.php";

class Autoload {
    public static $path;
    public static $managerPath;
    public static $paginatorPath;
    public static $corePath;
    public static $classesPath;
    public static $externalPath;
    public static function init() {
        self::$path = $_SERVER["DOCUMENT_ROOT"] . "/api/private";
        self::$managerPath = self::$path . "/views/managers/";
        self::$paginatorPath = self::$path . "/paginator/";
        self::$corePath = self::$path . "/core/";
        self::$classesPath = self::$path . "/classes/";
        self::$externalPath = self::$classesPath . "external/";
    }
    public static function isManager($className) {
        if (substr($className, -7) == "Manager") {
            return strtolower(substr($className, 0, -7));
        }
    }
    public static function isPaginator($className) {
        return substr($className, -9) == "Paginator";
    }
    public static function isExternal($className) {
        $externalClasses = [
            "Datalix",
            "Discord",
            "Tumblr"
        ];

        return in_array($className, $externalClasses);
    }
    public static function isCore($className) {
        $coreClasses = [
            "Helper",
            "IP",
            "Server",
            "Crypt"
        ];

        return in_array($className, $coreClasses);
    }
    public static function isRegular($className) {
        return !self::isManager($className) && !self::isPaginator($className) && !self::isExternal($className) && !self::isCore($className);
    }
}

Autoload::init();

spl_autoload_register(function($className) {
    if (Autoload::isManager($className)) {
        include_once Autoload::$managerPath . Autoload::isManager($className) . ".php";
    }
    if (Autoload::isPaginator($className)) {
        include_once Autoload::$paginatorPath . $className . ".php";
    }
    if (Autoload::isExternal($className)) {
        include_once Autoload::$externalPath . $className . ".php";
    }
    if (Autoload::isCore($className)) {
        include_once Autoload::$corePath . $className . ".php";
    }
    if (Autoload::isRegular($className)) {
        include_once Autoload::$classesPath . $className . ".php";
    }
});
?>