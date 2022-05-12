<?php

session_start();

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/productRepo.php";
require_once "../util/authorize.php";

if(!Validator::isSignedIn()) {
    $response = new Response(401, "Not signed in");
    echo $response->toJson();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['user'])) {
        $response = new Response(302, ProductRepo::getAllByUser($_SESSION['user']));
    }
    else {
        $response = new Response(302, ProductRepo::getAll());
    }
    echo $response->toJson();
}
else if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    try {
        authorize($_SESSION['user'], 'admin');
    } catch (Exception $e) {
        $response = new Response(403, $e->getMessage());
        echo $response->toJson();
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    try {
        ProductRepo::createProduct($data['name'], $data['productType']); 
        $response = new Response(201, "Product added successfully");
    } catch (Exception $e) {
        $response = new Response(409, $e->getMessage());
    }

    echo $response->toJson();
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
}
