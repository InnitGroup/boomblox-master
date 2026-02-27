<?php
#made: 01/04/2025 @marsoc
#last edit: 03/06/2025 @marsoc: Boomblox.Places->Boomblox.Games
error_reporting(E_ALL);
ini_set('display_errors', 1);

$root = $_SERVER['DOCUMENT_ROOT'];
$dir = (object)[
    "classes" => $root . "/api/private/classes/",
    "core" => $root . "/api/private/core/",
    "paginators" => $root . "/api/private/paginators/",
    "views" => $root . "/api/private/views/",
    "components" => $root . "/api/private/views/components/",
    "managers" => $root . "/api/private/views/managers/",
];

require_once $root . "/api/private/core/autoload.php";
require_once $root . "/Thumbs/Avatar.php";
require_once $root . "/Thumbs/Asset.php";

#set_error_handler(['ErrorHandler', 'handle']);

#CONSTANTS
define('maintenance', Setting::enabled("Maintenance")); #Setting::enabled("Maintenance");
const passwordLocked = false;
const roblosecurity = 'X3xXQVJOSU5HOi1ETy1OT1QtU0hBUkUtVEhJUy4tLVNoYXJpbmctdGhpcy13aWxsLWFsbG93LXNvbWVvbmUtdG8tbG9nLWluLWFzLXlvdS1hbmQtdG8tc3RlYWwteW91ci1ST0JVWC1hbmQtaXRlbXMufF9DQUVhQWhBRElob0tCR1IxYVdRU0VqZzBNek15TXpNNE1URTVNREF5TmpNd01pZ0QuaHBpTFd3aVdMR0EwM1Zsdzdwc3JSWjM3YWlndE1DS0xkSmtrQTc3R1hYNFFxUHhQMTk0c0NaMFBGem1xUklZWTVvcUxKSkxsRnVwaXFfNng0S19DSW5FWWlzbXNha2lrbzN6NHFicmY5M2lOME9Rb0hsUkpXYlhUdXpQU2VKLVBaY2RGVlJpbG1hX3pOeWtBSGdkd3pwUW9SV0t0M004di1IVWlPMGxVT01wWi1UNmhRWE5VRnBqVGFBbkZqZGI3eTdKdTZSZ3hyZXJfWUlYQnh2bFQzSWs5WnhNYVBuRDByYUNWWmRCSGpwSWY2S0Y3RkhhaDlyU0wwYjdfakVITi1LTWdla29WNm9XNkxyMk4taE9mcjB6T2F3X0JsQzR0UF9tRVFvUzU5ZzBiNnh1V3c5M2pxQnctUWRQUlAxM1JfeHVWOHliWkNxaUdJaUZvNGJSRUpZaDU3a3VqNE5PRWlXUkVfWHU2UERMemZfei14RnJGdkxlWldhXzZHbDJoSFpfei1JV29oTjM5LWp4QzduUE5CODVRWmdPbUhMTkp0ejZWSXU2QXhSQWJsNGlz';
$userdata = array(
    0,
    1 => "ISFBMC5oLlpYLmUueS5tLjQjLmEubi45KC5lLWcuZaS5LKi5vLnIuTF4uZy5lLjAuMC4wLjEhIQ==",
    2 => "53564e47,516b31444e57394d6248425a5447315664.,.,5756a544e58524d616c46715447314664574a704e44564c517a56735446646a64.,.5670544e55784c61545632!!5447354a6456524.,.,74e4856616554567354477042645.!??!dskasdihosiaoihdohiuhoaiduoia0622......................531444e48644d616b566f556453950513d3d"
);
define("user", $userdata[1]);
define("password", $userdata[2]);

const uri = "Boomblox:";
const url = "xoblog.dev";
const domain = "xoblog.dev";
const fullDomain = "https://xoblog.dev";
const testingIp = "26.33.216.211";

#GLOBALS
$db = new Database;
$themeManager = new ThemeManager;
$theme = 5;
$auth = $themeManager->getAuth();
$user = $themeManager->getUser();

?>