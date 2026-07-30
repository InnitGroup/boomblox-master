<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/private/core/main.php";

global $theme, $auth, $user;
!$auth->isAuthed() && Server::_404();

if (Server::isPost()) {
    if (isset($_POST['__EVENTARGUMENT']) && isset($_POST['__EVENTTARGET'])) {
        if ($_POST['__EVENTTARGET'] == 'ctl00$cphRoblox$RemoveAd') {
            $adToRemove = (int)$_POST['__EVENTARGUMENT'];
            if (UserAd::exists($adToRemove)) {
                $ad = new UserAd($adToRemove);
                $ad->remove();
                exit(header("Location: /My/AdInventory.aspx"));
            }
        }
    }    
}

$page = new PageBuilder("Free Games at " . Site::getThemeProperty("titleUrl", $theme), $theme, "/templates/authheader.php", [], "edititem"); # 
$page->buildHeader();

PageBuilder::addComponent("userad", "inventory");

$page->buildFooter();
?>