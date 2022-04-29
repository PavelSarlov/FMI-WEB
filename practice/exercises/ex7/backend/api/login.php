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
        $response = new Response(302, json_encode($user, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); 
        echo $response->toJson();
        exit();
    }
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
    exit();
}

?>
