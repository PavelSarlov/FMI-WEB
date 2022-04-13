<?php
include "FormValidator.php";

$data = json_decode(file_get_contents("php://input"));

$result = ["success"=>false, "errors"=>[]];

if($valid = FormValidator::validateName($data)) {
    $result["errors"]["name"] = $valid; 
}
if($valid = FormValidator::validateTeacher($data)) {
    $result["errors"]["teacher"] = $valid; 
}
if($valid = FormValidator::validateDescription($data)) {
    $result["errors"]["description"] = $valid; 
}
if($valid = FormValidator::validateGroup($data)) {
    $result["errors"]["group"] = $valid; 
}
if($valid = FormValidator::validateCredits($data)) {
    $result["errors"]["credits"] = $valid; 
}

if (count($result["errors"]) == 0) {
    unset($result["errors"]);
    $result["success"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
