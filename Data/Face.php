<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
$id = (int)$_GET["ID"];
#if ($_SERVER["HTTP_USER_AGENT"] == "Roblox/WinInet") {
    $file = new File("/api/private/xml/Face.xml", ["1" => "http://" . domain . "/asset/?id=$id"]);
    echo $file->handle();
#}
?>