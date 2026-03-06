<?php
class PageBuilder {
    private array $content;

    public function __construct($title = "", $theme = 0, $header = "/templates/authheader.php", $n = [], $jsList = [], $hasAds = false) {
        $this->content["title"] = $title;
        $this->content["theme"] = $theme;
        $this->content["header"] = $_SERVER['DOCUMENT_ROOT'] . $header;
        $this->content["hasAds"] = $hasAds;

        if (isset($jsList)) {
            if (is_array($jsList)) {
                foreach ($jsList as $js) {
                    $this->content["jsList"][] = $js;
                }
            } else {
                $this->content["jsList"] = [$jsList];
            }
        } else {
            $this->content["jsList"] = null;
        }

    }

    public function setImageForm() {
        $this->content["enc"] = "multipart/form-data";
    }

    public function buildHeader() {
        $title = $this->content["title"];
        $jsList = null;
        $enc = null;
        $hasAds = $this->content["hasAds"];
        
        if (isset($this->content["jsList"])) {
            $jsList = $this->content["jsList"];
        }

        if (isset($this->content["enc"])) {
            $enc = $this->content["enc"];
        }

        $packed = compact("title", "jsList", "enc");
        $headerPacked = compact("title", "jsList", "enc", "hasAds");
        
        if ($this->content["header"] == $_SERVER['DOCUMENT_ROOT'] . "/templates/authheader.php") {
            self::addComponent("page", "header", $packed);
        } else {
            self::addComponent("page", "dryheader", $packed);
        }
    }
    public function buildFooter() {
        global $theme, $user;
        $packed = compact("theme");
        self::addComponent("page", "footer", $packed);

        if (isset($user)) {
            if ($user->hasPerms(3)) {
                self::addComponent("admin", "portable");
            }
        }
    }

    public static function addComponent($folder, $component, $data = []) {
        global $dir;
        if (!empty($data)) {
            extract($data);
        }

        include $dir->components . $folder . "/" . $component . ".php";
    }
}
?>