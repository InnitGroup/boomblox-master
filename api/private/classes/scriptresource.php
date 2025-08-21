<?php
class ScriptResource {
    private $jsPath = '/api/private/js/';
    public function __construct($data) {
        $this->handleData($data);
    }
    public function handleData($d) {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $data = base64_decode($d);
        if (file_exists($root . $this->jsPath . $data . ".js")) {
            include_once $root . $this->jsPath . $data . ".js";
        }
        /*
        switch (base64_decode($d)) {
            case "data":
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/main.js";
                break;
            case "data2":
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/postback2.js";
                break;
            case 'ct100$rbx$character':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/character.js";
                break;
            case 'ct100$rbx$myplace':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/myplace.js";
                break;
            case 'ct100$rbx$csettings': #https://developer.mozilla.org/en-US/docs/Web/API/Node/firstChild, https://developer.mozilla.org/en-US/docs/Web/API/Element/children
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/csettings.js";
                break;
            case 'ct100$rbx$rbxnews':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/rbxnews.js";
                break;
            case 'ct100$rbx$upload':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/upload.js";
                break;
            case 'ct100$rbx$ide':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/ide.js";
                break;
            case 'ctl00$rbx$edititem':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/edititem.js";
                break;
            case 'ctl100$rbx$friends':
                include_once $_SERVER["DOCUMENT_ROOT"] . "/api/private/js/friends.js";
                break;
        }*/
    }
}
?>