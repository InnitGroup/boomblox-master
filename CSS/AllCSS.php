<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;



$versionIndicator = $_GET["v"] ?? 0;
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css")) {
    header("Content-Type: text/css");
    $css = $_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css";
    include_once $css;
}

exit;
?>