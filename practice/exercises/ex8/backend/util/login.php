<?php

require_once "../repo/userRepo.php";

enum LoginStatus {
    case SUCCESS;
    case WRONG_PASSWORD;
    case WRONG_EMAIL;
}

function login($data) {
    if ($user = UserRepo::getByEmail($data['email'])) {
        if (!password_verify($data['password'], $user['password'])) {
            return LoginStatus::WRONG_PASSWORD;
        }

        session_start();

        $_SESSION['user'] = $user['id'];

        setcookie('email', $data['email'], time() + 600, '/');
        setcookie('password', $data['password'], time() + 600, '/');

        return LoginStatus::SUCCESS;
    }
    else {
        return LoginStatus::WRONG_EMAIL;
    }
}

?>
