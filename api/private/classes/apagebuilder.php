<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc

global $auth;
!$auth->hasPerms(3) && Server::_404();

class APageBuilder {
    private $theme;
    public function __construct($theme = 0) {
        $this->theme = $theme;
    }
    public function buildHeader($default = true, $dashboard = true) {
        $theme = $this->theme;
        include_once $_SERVER['DOCUMENT_ROOT'] . "/aaa/components/head.php";
        if ($dashboard) {
            if ($default) {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/aaa/components/admindashboard.php";
            } else {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/aaa/components/altdashboard.php";
            }
        }
    }
    public function buildFooter() {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/aaa/components/adminend.php";
    }
}
?>