<?php
#made: 01/19/2025 @marsoc
#last edit: 01/19/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

if (!$auth->isAuthed()) {
	Server::_404();
}

$user = $_GET["userid"] ?? NULL;
$key = $_GET["key"] ?? NULL;
$asset = $_GET["assetnumber"] ?? NULL;

switch ($key) {
    # this has been here since jan 2025, unused
    /* case "Apostles":
    */

    # october 1st, 2025 - yorick's resting place event
    case "H3d1dTh3M0nst3rM4sh":
        
        break;
}
?>