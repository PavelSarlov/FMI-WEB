<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/productRepo.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $response = new Response(302, ProductRepo::getAllByUser($_SESSION['user']));
    }
    catch (Exception $e) {
        $response = new Response(403, "Not signed in");
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
