<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

// EXAMPLE:
// game:HttpGet("http://xoblog.dev/api/public/GetData.ashx?key=ABCD-1234-EFGH-5678&data=[user=3;coins]")

$privateKey = $_GET["key"];
if (!Datastore::keyExists($privateKey)) {
    Server::_404();
}

$datastore = Datastore::get("A");
$data = unserialize($datastore["data"]);

foreach ($data as $key => $nData) {
    echo $key; # user
    print_r($nData); # data
    echo "<br>";
}
?>