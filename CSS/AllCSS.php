<?php
$versionIndicator = $_GET["v"] ?? 0;
if ($versionIndicator == 1) {
    $versionIndicator = 5;
}
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css")) {
    header("Content-Type: text/css");
    $css = $_SERVER["DOCUMENT_ROOT"] . "/CSS/AllCSS" . $versionIndicator . ".css";
    include_once $css;
}

exit;
?>