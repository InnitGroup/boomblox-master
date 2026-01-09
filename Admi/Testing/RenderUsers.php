<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

for ($i = 98; $i <= 136; $i++) {
    echo $i;
    $render = new Avatar($i);
    $render->RequestThumbnail(540,660,"PNG");
    $render->RequestThumbnail(500,500,"PNG");
    $render->RequestThumbnail(100,100,"JPG");
}

echo "Rendered!";
?>