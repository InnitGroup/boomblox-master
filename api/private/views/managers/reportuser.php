<?php
class ReportUserManager {
    private $post;
    private $get;
    public function __construct() {
        $this->handle();
    }
    public function handle() {
        if (!empty($_POST)) {
            if (str_contains($_POST["__EVENTARGUMENT"], "$")) {
                $decrypted = explode("$", $_POST["__EVENTARGUMENT"]);
                $action = $decrypted[1];
                switch ($action) {
                    case "ct100Report":
                        #
                        break;
                    case "ct101Report":
                        if (isset($_GET["ReturnUrl"])) {
                            $returnUrl = urldecode($_GET["ReturnUrl"]);
                            header("Location: ".$returnUrl);
                        }
                        break;
                    default:
                        break;
                }
            } 
        }
    }
}
?>