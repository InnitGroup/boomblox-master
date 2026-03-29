<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $db, $auth;
$port = $_GET["Port"] ?? Server::_404();
$key = $_GET["Key"] ?? Server::_404();

if ($port < 31000 || $port > 32000) {
    exit;
}

if (!isset($key) || empty($key)) {
   exit;
}

if ($key !== Gameservers::getAPIKey("Close")) {
    exit;
}

if (!$auth->isAuthed() && !Server::isLocal()) {
    exit;
}

$stmt = "DELETE FROM servers WHERE port=:port";
$db->execute($stmt, [":port" => $port]); # + 1001

$cmd = "netstat -aon | findstr :".$port;
$result = shell_exec($cmd);
$explodedResult = explode("* ", $result);
$pid = trim($explodedResult[1]);

$cmd = "taskkill /PID $pid /F";
shell_exec($cmd);

echo "Server stopped";
?>