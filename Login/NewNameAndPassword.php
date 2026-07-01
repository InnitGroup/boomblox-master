<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
if (!$auth->isAuthed()) {
    !isset($_GET["Age"]) && Server::_404();
    $_GET["Age"] !== "Over12" && exit(header("Location: https://www.youtube.com/watch?v=ZjYBNJBrWIc"));
}

$register = new Registration;
$error = null;
$result = null;

if (Server::isPost()) {
    if (rand(1, 200) > 1) {
        $result = $register->handle();

        if (!isset(json_decode($result)->error)) { #x: registry passed
            header("Location: /Default.aspx"); #eat pie first you noob! seariously! go get me some pie!
            exit;
        } else {
            $error = json_decode($result)->focus;
        }  
    } else {
        $result = json_encode(array("error" => "eat pie first you noob! seariously! go get me some pie!", "focus" => "EnterUsername"));
        $error = json_decode($result)->focus;
    }
}

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url")), 0, "/templates/dryheader.php", [], ["register"]);

$page->buildHeader();
PageBuilder::addComponent("register", "newnameandpassword", compact("register", "error", "result"));
$page->buildFooter();
?>