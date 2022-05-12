<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../util/login.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (Validator::isSignedIn()) {
        $response = new Response(302, $_SESSION['user']);
    }
    else if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        switch(login($_COOKIE)) {
            case LoginStatus::SUCCESS:
                $response = new Response(302, $_SESSION['user']);
                break;
            case LoginStatus::WRONG_EMAIL:
            case LoginStatus::WRONG_PASSWORD:
                $response = new Response(401, "Not signed in");
                break;
        }
    }
    else {
        $response = new Response(401, "Not signed in");
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
