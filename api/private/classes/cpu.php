<?php

# for machine interaction/data
class CPU {
    # how many cpus there are in all of our machines
    private static int $cpuCount = 12;

    # how many machines we have
    private static int $machineCount = 1;

    # how much ram (in bytes) we have
    private static int $ram = 32000000;
    public static function toMB(int $size): float|int {
        return $size/1000;
    }
    public static function toGB(int $size): float|int {
        return $size/1000000;
    }
    public static function getCpuUsagePct() {
        return self::computePct(self::getUsage()/self::$cpuCount);
    }
    public static function getMachineUsagePct() {
        return self::computePct(self::getUsage());
    }
    public static function computePct($pct) {
        return ceil($pct*1000)/1000;
    }
    public static function getMachines() {
        return self::$machineCount;
    }
    public static function getCPUs() {
        return self::$cpuCount;
    }
    public static function getRam() {
        return self::$ram;
    }
    public static function saveUsage() {
        exec('typeperf "\Processor(_Total)\% Processor Time" -sc 1', $output);
        if (isset($output[2]) && preg_match('/"([\d.]+)"/', $output[2], $matches)) {
            $cpuUsage = $matches[1];
            $file = fopen($_SERVER["DOCUMENT_ROOT"]."/api/private/core/cpulog.txt", "w");
            fwrite($file, $cpuUsage);
            fclose($file);
        }
    }
    public static function getUsage() {
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/api/private/core/cpulog.txt")) {
            $file = $_SERVER["DOCUMENT_ROOT"]."/api/private/core/cpulog.txt";
            if (filemtime($file) > time()-3600) {
                return file_get_contents($file);
            } else {
                self::saveUsage();
                return file_get_contents($file);
            }
        }
    }
}

?>