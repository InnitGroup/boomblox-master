<?php

# base class (future use)
class Base {
    # singleton object of the inheriting class
    private static $instance = NULL;

    # path of the class inheriting the base class
    private static $path = NULL;

    # main constructor
    public function __construct() {
        $instance = $this;
    }

    # registers a new class
    public function registerClass($x,$y) {}

    # return the singleton object ($instance)
    public function _staticInstance() {return $this->instance;}

    # sets path
    public function set_path($path) {$this->path = $path;}

    # gets path
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