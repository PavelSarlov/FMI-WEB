<?php
include "utils.php";

$data = json_decode(file_get_contents("php://input"));

$result = ["success"=>false, "errors"=>[]];

if($valid = !validateName($data)) {
    $result["errors"] += $valid; 
}

/* $name = $data->{"name"}; */
/* $teacher = $data->{"teacher"}; */
/* $description = $data->{"description"}; */
/* $group = $data->{"group"}; */
/* $credits = $data->{"credits"}; */

if (count($result["errors"]) == 0) {
    unset($result["errors"]);
    $result["success"] = true;
}

return json_encode($result);

?>
