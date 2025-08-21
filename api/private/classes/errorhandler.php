<?php
class ErrorHandler {
    public static function handle($errno, $errstr, $errfile, $errline) {
        if (!(error_reporting() & $errno)) {
            return false;
        }
        
        $errstr = htmlspecialchars($errstr);

        switch ($errno) {
            case E_USER_ERROR:
                PageBuilder::addComponent("errorhandler", "main", compact("errno", "errstr", "errline", "errfile"));
                exit(1);

            case E_USER_WARNING:
                PageBuilder::addComponent("errorhandler", "main", compact("errno", "errstr", "errline", "errfile"));
                break;

            case E_USER_NOTICE:
                PageBuilder::addComponent("errorhandler", "main", compact("errno", "errstr", "errline", "errfile"));
                break;

            default:
                PageBuilder::addComponent("errorhandler", "main", compact("errno", "errstr", "errline", "errfile"));
                break;
        }

        return true;
    }
}
?>