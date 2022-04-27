<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require "FormValidator.php";
    
    if (array_key_exists('Content-Type', getallheaders())) {
        $data = json_decode(file_get_contents("php://input"), true);
    }
    else {
        $data = $_POST;
    }

    $validator = new FormValidator();

    $validator->validateName($data);
    $validator->validateTeacher($data);
    $validator->validateDescription($data);
    $validator->validateGroup($data);
    $validator->validateCredits($data);

    header('Content-Type: application/json');
    echo $validator->getResult()->toJson();
}

?>
