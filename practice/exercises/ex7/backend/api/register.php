<?php

require "../vo/response.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    try {
        if (!$data->{"username"} || !$data->{"password"}) {
            throw new Exception("Required fields are empty");
        }

        $username = $data->{"email"};
        $password = $data->{"password"};
    }
    catch (Exception $e) {
        $result["success"] = false;
        $result["errors"][] = $e->getMessage();
    }
}
else {
    $result = new Response(400, "Bad Request");
    http_response_code($result->getStatusCode());
    echo $result->toJson();
    return;
}

header("Content-Type: application/json");
echo json_encode($result);

?>
