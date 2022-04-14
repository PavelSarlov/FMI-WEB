<?php

include "UserRepo.php";
include "ProductRepo.php";
include "Validator.php";

$result = [
    "success"=>true
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    try {
        if (!$data->{"username"} || !$data->{"password"}) {
            throw new Exception("Required fields are empty");
        }

        $username = $data->{"username"};
        $password = $data->{"password"};

        if(!Validator::validateUsername($username)) {
            throw new Exception("Invalid username");
        }

        if(!Validator::validatePassword($password)) {
            throw new Exception("Invalid password");
        }

        if(!UserRepo::createUser($username, $password)) {
            throw new Exception("User already exists");
        }
    }
    catch (Exception $e) {
        $result["success"] = false;
        $result["errors"][] = $e->getMessage();
    }
}
else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $result["data"] = ProductRepo::getAll();
}

header("Content-Type: application/json");
echo json_encode($result);

?>
