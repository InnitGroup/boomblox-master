<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $auth, $user;

!$auth->isAuthed() && Server::_404();

$file = $_SERVER["DOCUMENT_ROOT"] . "/api/private/apps/032A.exe";
if (isset($_GET["Special"])) {
    switch ($_GET["Special"]) {
        case "XPTesterGC":
            $xpTesters = [3, 115, 103, 118, 91, 102];
            if (!in_array($user->getUserId(), $xpTesters)) {
                Server::_404();
            }

            $file = $_SERVER["DOCUMENT_ROOT"] . "/api/private/apps/BoombloxXP.zip";
            break;
        case "QATester030D":
            /*
            $qaTesters = [3, 78, 99, 113, 79, 85, 105, 91, 100, 108, 93, 73, 96];
            if (!in_array($user->getUserId(), $qaTesters)) {
                Server::_404();
            }

            $file = $_SERVER["DOCUMENT_ROOT"] . "/api/private/apps/030D.exe";
            */
            break;
    }
}

if (file_exists($file)) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($file));
    header('Pragma: public');
    header('Cache-Control: must-revalidate');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);
    exit;
}
?>