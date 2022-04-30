<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (Validator::isSignedIn()) {
        $response = new Response(302, $_SESSION['user']);
    }
    else {
        var_dump($_SESSION);
        $response = new Response(401, "Not signed in");
    }

    echo $response->toJson();
    exit();
}
else {
    $response = new Response(400, "Bad Request");
    echo $response->toJson();
    exit();
}

?>
