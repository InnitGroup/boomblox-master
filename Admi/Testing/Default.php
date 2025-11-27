<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";
global $theme, $auth, $db;
!$auth->isAuthed() && Server::_404();;

$page = new APageBuilder;

#echo Thumbnail::extractSkybox($_SERVER["DOCUMENT_ROOT"] . "/content/1701");
echo '<img src="'.Thumbnail::extractSkybox($_SERVER["DOCUMENT_ROOT"] . "/content/1701") . '">';

?>