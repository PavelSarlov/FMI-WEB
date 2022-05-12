<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../util/authorize.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (Validator::isSignedIn()) {
        try {
            $response = new Response(200, authorize($_SESSION['user'], 'admin'));
        } catch (Exception $e) {
            $response = new Response(403, $e->getMessage()); 
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
