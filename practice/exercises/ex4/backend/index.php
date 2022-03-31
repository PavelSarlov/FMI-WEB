<?php

include("User.php");

$data = json_decode(file_get_contents("php://input"));

$user = new User($data->{"username"}, $data->{"password"});

echo json_encode(['user' => $user->getUsername()]);

?>
