<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $user;

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$versionIndicator = $_GET["v"] ?? 0;
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css")) {
    header("Content-Type: text/css");
    $css = $_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css";
    include_once $css;
}
?>