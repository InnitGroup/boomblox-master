<?php
class AdManager {
    public function __construct() {
        if (Server::isPost()) {
            echo 1;
        }
    }
}
?>