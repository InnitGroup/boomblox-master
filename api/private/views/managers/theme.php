<?php
class ThemeManager {
    private $auth;
    private $user;
    private $theme;

    public function __construct() {
        $this->auth = new Authentication;
        $this->theme = 0;
        if ($this->auth->isAuthed()) {
            $this->user = $this->auth->user;
            $this->theme = $this->user->getData("user","theme");
        }
    }
    public function getTheme() {
        return $this->theme;
    }
    public function getAuth() {
        return $this->auth;
    }
    public function getUser() {
        return $this->user;
    }
}
?>