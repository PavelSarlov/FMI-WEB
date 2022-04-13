<?php
include "utils.php";

$data = json_decode(file_get_contents("php://input"));

$result = ["success"=>false, "errors"=>[]];

if(($valid = validateName($data)) && !$valid->{"success"}) {
    $result["errors"][] = $valid->{"msg"}; 
}
if(($valid = validateTeacher($data)) && !$valid->{"success"}) {
    $result["errors"][] = $valid->{"msg"}; 
}
if(($valid = validateDescription($data)) && !$valid->{"success"}) {
    $result["errors"][] = $valid->{"msg"}; 
}
if(($valid = validateGroup($data)) && !$valid->{"success"}) {
    $result["errors"][] = $valid->{"msg"}; 
}
if(($valid = validateCredits($data)) && !$valid->{"success"}) {
    $result["errors"][] = $valid->{"msg"}; 
}

if (count($result["errors"]) == 0) {
    unset($result["errors"]);
    $result["success"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
