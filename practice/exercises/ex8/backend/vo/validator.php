<?php

class Validator {
    public static function validateEmail($data) {
        if (!isset($data['email'])) {
            return false;
        }
        return filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }

    public static function validatePassword($data) {
        if(!isset($data['password'])) {
            return false;
        }
        $password = $data['password'];
        return mb_strlen($password) >= 8 &&
            preg_match("/[[:upper:]]/", $password) &&
            preg_match("/[[:lower:]]/", $password) &&
            preg_match("/\d/", $password);
    }

    public static function isSignedIn() {
        return isset($_SESSION['user']);
    }

    public static function authorize($user, $role) {
        return $user['role'] === $role;
    }
}

?>
