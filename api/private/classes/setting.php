<?php
class Setting {
    private $name;
    public function __construct(string $setting) {
        if (!file_exists($_SERVER["DOCUMENT_ROOT"]."/api/private/settings/".$setting)) {
            throw new Exception("Bad setting");
        } 

        $this->name = $setting;
    }

    public static function new(string $setting, int $value) {
        if ($value < 0 || $value > 1) {
            throw new Exception("Bad value");
        }

        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/api/private/settings/".$setting, $value);

        global $db;
        $stmt = "INSERT INTO settings (`option`, `value`) VALUES (:setting, :val)";
        $db->execute($stmt, [
            ":setting" => $setting,
            ":val" => $value
        ]);
    } 

    public static function exists(string $setting)  {
        return file_exists($_SERVER["DOCUMENT_ROOT"]."/api/private/settings/".$setting);
    }

    public function set(int $value) {
        if ($value < 0 || $value > 1) {
            throw new Exception("Bad value");
        }

        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/api/private/settings/".$this->name, $value);
    }

    public static function enabled(string $setting) {
        $path = $_SERVER["DOCUMENT_ROOT"] . "/api/private/settings/" . $setting;

        if (!file_exists($path)) {
            error_log("Setting not found: $path");
            return false;
        }

        $value = trim(file_get_contents($path));
        return $value === '1';
    }

    public static function disabled(string $setting) {
        $path = $_SERVER["DOCUMENT_ROOT"] . "/api/private/settings/" . $setting;

        if (!file_exists($path)) {
            error_log("Setting not found: $path");
            return false;
        }

        $value = trim(file_get_contents($path));
        return $value === '0';
    }
}
?>