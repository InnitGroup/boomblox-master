<?php
class HomeManager {
    private $theme;
    private $user;
    
    public function __construct() {
        global $user, $theme;
        $this->theme = (int)$theme;
        $this->user = $user;
    }

    public function start() {
        PageBuilder::addComponent("home", "start");
    }
}
?>