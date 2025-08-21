<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && header("Location: /Welcome.php");

$page = new APageBuilder($theme);

exit;
for ($i = 0; $i < 114; $i++) {
    $render = new Avatar($i);
    $render->RequestThumbnail(540,660,"PNG");
    $render->RequestThumbnail(500,500,"PNG");
    $render->RequestThumbnail(100,100,"JPG");
}

echo "Rendered!";

?>