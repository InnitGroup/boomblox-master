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
const roblosecurity = 'X3xXQVJOSU5HOi1ETy1OT1QtU0hBUkUtVEhJUy4tLVNoYXJpbmctdGhpcy13aWxsLWFsbG93LXNvbWVvbmUtdG8tbG9nLWluLWFzLXlvdS1hbmQtdG8tc3RlYWwteW91ci1ST0JVWC1hbmQtaXRlbXMufF9DQUVhQWhBRElod0tCR1IxYVdRU0ZERTFNREU1TkRVeU5UVXhNakEyTkRNd01UTTRLQVEuZ2dFZ21sT05La1p2YnRNVnd4aXpIa2ROQUFOd0ZFbDY2aVlwbEV5anhhZXg1T3ViRXIwQ01pVktNQTg1VlBaQWtxYXdIMklWTDB6T094OUZnM2hMNl96Y1lNcUlRcHRXLTQtMXJPd20wMTc0NzhTdEF6Z3lxUjVIUW9qUHVXZ0lwUWRkb3NWbmRVQnhUdDJaVm1pN1l6Smk5YjZSbjQtT0lCaTZYMG9weUVOVEsxdkxUZmtmUjJkaGk5SThVR0x3VGRPM0o1V21aNDc1VGlFOXZlX2RodXM4dzRWeUhTWnAxYUxmdVFQRXo3VG9zYm50LS0yYUpEdVlhNjdFNWhPaUh5aUM4TFByckJPdE5vRGREN1I4b0pmUWNkcEh5eFo0Tms4SzVGSmlVLVBrZWtzZnFvQXZfUnQ5UGNyY2MzM2daRFpUNEprVVJwTmhXMzZuNXZEN0NOVWhqVVJBbFhXUWlZdzNNYVZ6Qi1SU1NZTjMtN2dFM01QU3V5bVlkb0c1WUI2NVd1LUdIdUdIY0VNSjY3WUJvdmNGbVVuRmlvZERzSl9zZDdVM1lvWXVFRkdfVG1NWTFxQUJRZm04MVp4YXhIR0NhMFNXRXN3V2ZhMnNxWnA3SVFnYWd1VVczS3RNa1NmNURXenpxVGpsYW44ZnJOcWtCSGp5QXlvSnljNGdoTU5xY21IVURRbVNxVmRPNDR6QWxGYTZLdWNzVUdNdE1QSUVNMm4teF80T3ZSVm9Ja0pFWUhWNTh0VENJQzFMNnoyLUF4VGNnQ3lsSXRMLUVId2VLaFB0SEprOF94QVJWQzZlYlFJWlNSMDFMYTA4SFRibXViRGtkUXY0UGowUjc2TEdBeE50bVlXaVFQZThWUUZLbDhVY0FJWjMtV2Y4dl9fR21xbm5maUpWTExNZ2ZucUNZVXV4ZFRtaXYtSE1pTTlEQ3RyWHdFSWVicXU4X0lxOTBFS28yd2pYNHlEV01rMFdWUzNsQm03c0pybVM1YjlVcllLdTV2dm94QTIyaW9vLWxaZjlVZWViUEk5cDg0X2pKWkZsWXBYRDZKNDFEQjVBOVdWN25lMXp6TW41WjZqbHY5SkVMX0FKTktFamlEQ3J4bFJybFVhUFF3YlVFem9FYXNNLWpmdWpTZWVsSkRCYTN0bV9LbTJHeHpOR19uaDFNRXFCb0FNRVF6T0Z0MWlrUEVvdm1FcEZrbVZqQzBOVXZVYTJOOU8tU0JXRjhTNW5qVVBzZ3JfaDJkQ1RjWEQ3YWxGWW1veDBDS2FzcnB0SmNJc2Q0YjlkR2czSy1EOS11NXVOS040';
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
$theme = $themeManager->getTheme();
$auth = $themeManager->getAuth();
$user = $themeManager->getUser();

?>