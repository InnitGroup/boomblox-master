<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
header("Content-type: text/plain");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

$user = new User($_GET["userId"]);
if (isset($_GET["IncludeGear"])) {
    if ($_GET["IncludeGear"] !== "0") {
        echo $user->getCharacterAppearance(false, unserialize($_GET["IncludeGear"]));
        exit;
    }
}

echo $user->getCharacterAppearance();
?>