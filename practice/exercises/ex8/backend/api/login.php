<?php

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/userRepo.php";
require_once "../util/login.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!Validator::validateEmail($data) ||
        !Validator::validatePassword($data)) {
        $response = new Response(400, "Invalid data");
        echo $response->toJson();
        exit();
    }

    switch(login($data)) {
        case LoginStatus::SUCCESS:
            $response = new Response(302, $_SESSION['user']);
            break;
        case LoginStatus::WRONG_EMAIL:
            $response = new Response(404, "User with such email doesn't exist");
            break;
        case LoginStatus::WRONG_PASSWORD:
            $response = new Response(401, "Invalid password");
            break;
    }

    echo $response->toJson();
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
}

?>
