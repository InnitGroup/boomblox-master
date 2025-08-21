<?php
class Error {
    public static function throw(string $error) {
        return (object)["Error" => $error];
    }
}
?>