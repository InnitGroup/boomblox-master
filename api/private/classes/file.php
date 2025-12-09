<?php
class File {
    private $file;
    private array $parameters;
    public function __construct($file, $parameters = []) {
        $this->file = $_SERVER["DOCUMENT_ROOT"] . $file;
        $this->parameters = $parameters;
    }
    public function handle() {
        if (file_exists($this->file)) {
            $contents = file_get_contents($this->file);
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $key => $value) {
                    $contents = str_replace("{".$key."}", $value, $contents);
                }
                return $contents;
            }
        } else {
            return "Error";
        }
    }

    public function links() {
        if (file_exists($this->file)) {
            $contents = file_get_contents($this->file);
            $contents = str_replace("http://www.roblox.com", "http://".domain, $contents);
            $contents = str_replace("http://roblox.com", "http://".domain, $contents);
            file_put_contents($this->file, $contents);
        }
    }

    public function getPlayerCount(): int {
        // <int name="MaxPlayers">12</int>
        $contents = file_get_contents($this->file);
        $half = explode('<int name="MaxPlayers">', $contents);
        $half = $half[1];
        $half = explode('</int>', $half);

        $playerCount = (int)$half[0];
        if ($playerCount < 1) {
            $playerCount = 1;
        }

        if ($playerCount > 50) {
            $playerCount = 50;
        }

        return $playerCount;
    }

    public static function isSkybox($file) {
        libxml_use_internal_errors(true);

        $xml = simplexml_load_file($file);
        if (!$xml) return false;

        if ($xml->getName() !== 'roblox') return false;

        $allowedClasses = ['Sky', 'Workspace'];

        foreach ($xml->children() as $child) {
            if ($child->getName() !== 'Item') {
                continue;
            }

            $classAttr = (string)$child['class'];
            if (!in_array($classAttr, $allowedClasses, true)) {
                return false;
            }
        }

        return true;
    }

    public static function isWebp($file) {
        $contents = file_get_contents($file);
        return str_contains($contents, "WEBPVP8X");
    }

    public static function hasLocalScripts($file) {
        $place = gzdecode(file_get_contents($file));
        return str_contains($place, "LocalScript") || str_contains($place, "HopperBin");
    }

    public static function isLuaModel($file) {
        libxml_use_internal_errors(true);

        $xml = simplexml_load_file($file);
        if (!$xml) return false;

        if ($xml->getName() !== 'roblox') return false;

        $allowedClasses = ['Script', 'Workspace'];

        foreach ($xml->children() as $child) {
            if ($child->getName() !== 'Item') {
                continue;
            }

            $classAttr = (string)$child['class'];
            if (!in_array($classAttr, $allowedClasses, true)) {
                return false;
            }
        }

        return true;
    }


    public static function getImageType($path) {
        $extensions = ['jpg', 'jpeg', 'png'];

        foreach ($extensions as $extension) {
            $fullPath = "$path.$extension";
            if (file_exists($fullPath)) {
                $info = getimagesize($fullPath);
                if ($info) {
                    $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
                    return ["FullPath" => $fullPath, "MIME" => $info["mime"], "Extension" => $extension];
                }
            }
        }
    }

    public static function JPGtoPNG($file, $destination) {
        $image = imagecreatefromjpeg($file);
        if ($image) {
            return imagepng($image, $destination);
        }
    }

    public static function assetExists(int $assetId): bool {
        $directory = $_SERVER["DOCUMENT_ROOT"] . "/content/";

        if (!file_exists($directory . $assetId)) {
            return false;
        }

        return true;
    }

    public static function assetVersionExists(int $assetId, int $versionId): bool {
        $directory = $_SERVER["DOCUMENT_ROOT"] . "/content/";

        if (!file_exists($directory . $assetId . "_" . $versionId)) {
            return false;
        }

        return true;
    }

    public static function getNextVersion(int $assetId): int {
        $directory = $_SERVER["DOCUMENT_ROOT"] . "/content/";

        # realizing sql might be a better option
        for ($i = 0; $i < 9999; $i++) {
            if (!file_exists($directory . $assetId . "_" . $i)) {
                return $i;
            }
        }

        return 10000;
    }
}
?>