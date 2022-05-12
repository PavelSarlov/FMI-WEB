<?php

require_once "../repo/userRepo.php";
require_once "../repo/roleRepo.php";

function authorize($userId, $roleToAuth) {
    $userRole = UserRepo::getUserRole($userId)['name']; 

    if ($userRole !== $roleToAuth) {
        throw new Exception("You don't have access to this page");
    }

    return "Authorized";
}

?>
