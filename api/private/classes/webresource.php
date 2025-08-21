<?php
class WebResource {
    public $contentType;
    private $contents = [
        "weDwHNf8bbif_oTohuSVVkwYBCZqUjYgXAU6MlMrcKY1" => [
            "type" => "image/png",
            "path" => "/aaa/images/lt01.png",
        ],
        "tce8FDaK7R0GBVxHP9c8yLtasErGofxcnEGyEUTof9AetA5-YPEOCwXmpH3_WE6R0" => [
            "type" => "image/png",
            "path" => "/aaa/images/lt02.png",
        ],
        "VD_Slylu6hlyEOuc5rdjWw2" => [
            "type" => "image/png",
            "path" => "/aaa/images/vd.png",
        ]
    ];
    public function __construct($data) {
        if (isset($data)) {
            $this->handleData($data);
        } else {
            $this->issueError("No resource input via WebResource.");
        }
    }
    public function issueError($error = "General WebResource error") {
        $this->contentType = "text/javascript";
        echo 'console.log('.$error.')';
    }
    public function handleData($d) {
        if (isset($this->contents[$d])) {
            $data = $this->contents[$d];
            $this->contentType = $data["type"];
            readfile($_SERVER["DOCUMENT_ROOT"].$data["path"]);
        } else {
            $this->issueError("The resource requested via WebResource doesn't exist.");
        }
    }
}
?>