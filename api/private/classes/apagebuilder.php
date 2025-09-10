<?php
#made: 04/20/2025 @marsoc
#last edit: 04/20/2025 @marsoc

global $auth, $user;
if (!$auth->hasPerms(3)) {
    if (isset($user)) {
        Discord::sendWebhookMessage("weird", $user->getUsername() . " tried to access the panel, but failed");
    } else {
        Discord::sendWebhookMessage("weird", "Someone unknown tried to access the panel, but failed");
    }
    
    Server::_404();  
}

# admin page builder, since there is a completely different page scheme
class APageBuilder {

    # defines current user theme
    private $theme;

    # main constructor
    public function __construct($theme = 0) {
        $this->theme = $theme;
    }

    # builds the admin panel header
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

    # builds the admin panel footer
    public function buildFooter() {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/aaa/components/adminend.php";
    }
}
?>