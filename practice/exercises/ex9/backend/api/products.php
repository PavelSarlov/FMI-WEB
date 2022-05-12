<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/productRepo.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(!Validator::isSignedIn()) {
        $response = new Response(401, "Not signed in");
    }
    else if(isset($_GET['user'])) {
        $response = new Response(302, ProductRepo::getAllByUser($_SESSION['user']));
    }
    else {
        $response = new Response(302, ProductRepo::getAll());
    }

    echo $response->toJson();
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
}

?>
