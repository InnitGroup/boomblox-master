<?php
#made: 03/28/2025 @marsoc
#last edit: 03/28/2025 @marsoc
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();;

$contentBuilder = new ContentBuilderManager;
$contentId = (int)$_GET["ContentType"];
$content = Helper::itemType($contentId);
$error = null;
$invalidTypes = [9, 10, 8, 17, 18, 19];

if (in_array($contentId, $invalidTypes)) {exit(header("Location: /My/ContentBuilder.aspx?ContentType=1"));}
if (!$content) {exit(header("Location: /My/ContentBuilder.aspx?ContentType=1"));}
if (!$content->IsContent) {exit(header("Location: /My/ContentBuilder.aspx?ContentType=1"));}

if (Server::isPost()) {
    $result = $contentBuilder->handleUpload($contentId, $content, $_POST);
    if (isset($result->Error)) {
        $error = $result->Error;
    }
}

$title = Site::getThemeProperty("alias",$theme)." ".$content->Type." Builder";

if ($content->Type == "NA") {
    $title = Site::getThemeProperty("alias",$theme)." Image Builder";
}


$page = new PageBuilder($title, $theme);
$page->setImageForm();

$page->buildHeader();
if ($contentId !== 1) {
    PageBuilder::addComponent("contentbuilder", strtolower($content->Type), compact("theme", "contentId"));
    $name = $content->Type;
    PageBuilder::addComponent("contentbuilder", "upload", compact("name", "error"));
} else {
    PageBuilder::addComponent("contentbuilder", "default");
}

$page->buildFooter();
?>