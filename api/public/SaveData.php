<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;

!$auth->isAuthed() && Server::_404();
#Server::ipLock();

// EXAMPLE:
// game:HttpGet("http://xoblog.dev/api/public/SaveData.ashx?key=ABCD-1234-EFGH-5678&data=[user=3;coins=100]")

$privateKey = $_GET["key"];
if (!Datastore::keyExists($privateKey)) {
    Server::_404();
}

$data = $_GET["data"];
$player = $_GET["player"];

Discord::sendWebhookMessage("weird", "[DATA ENTRY]: $player saving data: $data");

$data = str_replace("[", "", $data);
$data = str_replace("]", "", $data);
$parsed = explode(";", $data);
$data = null;

$data = [$player => []];

$name = $parsed[0];
$name = explode("=", $name);
$name = $name[1];

$value = $parsed[1];
$value = explode("=", $value);
$value = $value[1];

$data[$player][$name] = $value;

Datastore::insertData($privateKey, $data, $player);

#print_r($data);
#Discord::sendWebhookMessage("weird", "[DATA ENTRY]: $player saved data: $data");
?>