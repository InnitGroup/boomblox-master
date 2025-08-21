<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

// EXAMPLE:
// game:HttpGet("http://bmblox.xyz/api/public/GetData.ashx?key=ABCD-1234-EFGH-5678&data=[user=3;coins]")

$privateKey = $_GET["key"];
if (Datastore::keyExists($privateKey)) {
    Server::_404();
}

$data = $_GET["data"];

?>