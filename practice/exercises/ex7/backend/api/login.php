<?php

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/userRepo.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!Validator::validateEmail($data) ||
        !Validator::validatePassword($data)) {
        $response = new Response(400, "Invalid data");
        echo $response->toJson();
        exit();
    }

    if ($user = UserRepo::getByEmail($data['email'])) {
        if (!password_verify($data['password'], $user['password'])) {
            $response = new Response(401, "Invalid password");
            echo $response->toJson();
            exit();
        }

        session_start();

        $_SESSION['user'] = $user['id'];
        $response = new Response(302, $_SESSION['user']);
    }
    else {
        $response = new Response(404, "User with such email doesn't exist");
    }

    echo $response->toJson();
    exit();
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
    exit();
}

?>
