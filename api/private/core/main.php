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
const roblosecurity = 'fFdBUk5JTkc6LURPLU5PVC1TSEFSRS1USElTLi0tU2hhcmluZy10aGlzLXdpbGwtYWxsb3ctc29tZW9uZS10by1sb2ctaW4tYXMteW91LWFuZC10by1zdGVhbC15b3VyLVJPQlVYLWFuZC1pdGVtcy58X0NBRWFBaEFESWhzS0JHUjFhV1FTRXpFNU56azVORFEzTnpNeU1qYzVNelU1T0RVb0F3LmY3Z2h4X3hpYW1jMVNVbmhlMl9pV3AtM0FiN1UxRGxFMDVkcU5EZW5oVmt3NjB0dU4tSHBYMmZIdVdOVXF1dTY1NEpMd0VZRHhlMkduYzA5WFNTb0g2dUw4Z3B2TlFra0hNRGVncDg3cGhWQ2dwQ1hLZUVxWWtENUxiR0tzUlJOdUVHMkczaUhWdWFheFVVTDNkZldoa3VBdjlBR2ZfTTgxQ2h0WE1WWHh6T19sOUp2bnN6T3NvZ0o1eUVEVXdaNXNkcldadlVjZGIxWEFKODlHUHF3eTlOWVlRelVSNWxwNGU4SUVDLWh6QkdiLS1Ic2dtdkJvMVNzUmpMOEF1OGpsVkxmdEFWUVJnZHEzRm9vYXZJZVo5TURzeFgtY0ZaNGVvZlBsVFpodDZGWUVxZGxycnVZS0lqZS1qTVJ6ZVF5NVBVV1RnREJ6WUEwWTMxWGxXY1Z6RGp0TXhPbHBuQzZXVWl0WUg3V0RGMWVoVENuOUtPRDVISzFodEVVdHIxWXVJWEx4ZEdkYlFSVVgwSk93dzVnbTNoamRQVQ==';
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