<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db;
$port = $_GET["Port"] ?? Server::_404();
$key = $_GET["Key"] ?? Server::_404();

if (Setting::disabled("Gameservers")) {
    exit;
}

if ($port < 1000 || $port > 2000) {
    exit;
}

if (!isset($key) || empty($key)) {
   exit;
}

if ($key !== Gameservers::getAPIKey("Close")) {
    exit;
}

$cmd = "netstat -aon | findstr :".$port;
$result = shell_exec($cmd);
$explodedResult = explode("* ", $result);
$pid = trim($explodedResult[1]);

$cmd = "taskkill /PID $pid /F";
shell_exec($cmd);

$stmt = "DELETE FROM servers WHERE port=:port";
$db->execute($stmt, [":port" => $port]);

echo "Server stopped";
?>