<?php
class Base {
    private static $instance = NULL;
    private static $path = NULL;
    public function __construct() {
        $instance = $this;
    }
    public function registerClass($x,$y) {}
    public function _staticInstance() {return $this->instance;}
    public function set_path($path) {$this->path = $path;}
    public function get_path() {
        $p = $this->path;
        if ($p) {
            return $p;
        } else {
            return $this->_staticInstance()->path;
        }
    }
}
?>