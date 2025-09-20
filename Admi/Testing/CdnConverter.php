<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

exit; 

#JPG: ����JFIF
#PNG: �PNG

function isPng(string $file): bool {
    return substr($file, 0, 8) === "\x89PNG\x0D\x0A\x1A\x0A";
}

$dir = $_SERVER["DOCUMENT_ROOT"] . "/cdn/t2";
foreach (glob($dir . "/*") as $filePath) {
    if (!is_file($filePath)) continue;

    if (isPng($filePath)) {
        $newPath = $filePath . ".png";
    } else {
        $newPath = $filePath . ".jpg";
    }

    if (!file_exists($newPath)) {
        rename($filePath, $newPath);
        echo "$filePath -> $newPath <br>";
    }
}
?>