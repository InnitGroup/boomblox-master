<?php
# sole controller class
class Controller {
    # requires authentication
    public static function requireAuth() {
        global $auth;
        !$auth->isAuthed() && header("HTTP/1.1 404 Not Found");
    }
}
?>