<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
$auth->isAuthed() && exit(header("Location: /Default.aspx"));

if (Server::isPost()) {
    if (isset($_POST["__EVENTTARGET"]) && !empty($_POST["__EVENTTARGET"])) {
        $target = $_POST["__EVENTTARGET"];
        switch ($target) {
            case 'ctl00$cphRoblox$rbxRegistration$AgeOption':
                if (isset($_POST["__EVENTARGUMENT"]) && !empty($_POST["__EVENTARGUMENT"])) {
                    $argument = $_POST["__EVENTARGUMENT"];
                    if ($argument !== "Over12") {
                        exit(header("Location: https://www.youtube.com/watch?v=ZjYBNJBrWIc"));
                    }

                    exit(header("Location: /Login/NewNameAndPassword.aspx?Age=Over12"));
                }
                break;
            case 'ctl00$cphRoblox$rbxParents':
                exit(header("Location: https://youtu.be/GRoa6w-wnT4?list=RDGRoa6w-wnT4&t=51"));
                break;
            default:
                break;
        }
    }
}

!isset($_GET["TimeOf"]) && Server::_404();
$_GET["TimeOf"] !== "OurLives" && Server::_404();

$page = new PageBuilder("Free Games at " . strtoupper(Site::getThemeProperty("url")), 0, "/templates/dryheader.php", [], ["register"]);

$page->buildHeader();
PageBuilder::addComponent("register", "newage");
$page->buildFooter();
?>