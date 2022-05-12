 <?php

require_once "../vo/response.php";
require_once "../vo/validator.php";
require_once "../repo/productRepo.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $response = new Response(302, ProductRepo::getProductTypes());
    } catch (Exception $e) {
        $response = new Response(500, "Something went wrong");
    }

    echo $response->toJson();
}
else {
    $response = new Response(400, "Invalid request");
    echo $response->toJson();
}

?>

