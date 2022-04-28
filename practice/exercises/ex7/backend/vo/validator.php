<?php

class Validator {
    public static function validateUsername($username) {
        return preg_match("/^[\w\d]{3,16}$/i", $username);
    }

    public static function validatePassword($password) {
        return mb_strlen($password) >= 6 &&
            preg_match("/[[:upper:]]/", $password) &&
            preg_match("/[[:lower:]]/", $password) &&
            preg_match("/\d/", $password);
    }
}

?>
