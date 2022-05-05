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

    try {
        UserRepo::createUser($data['email'], $data['password']);
        $response = new Response(200, "Registration successful");
    } 
    catch(Exception $e) {
        switch($e->getCode()) {
            case 23000:
                $response = new Response(409, "User with such email already exists");
                break;
            default:
                $response = new Response(500, "Something went wrong");
        }
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
