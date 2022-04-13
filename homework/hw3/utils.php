<?php

class ValidateResult {
    function __construct($success, $msg) {
        $this->{"success"} = $success;
        $this->{"msg"} = $msg;
    }
}

function validateName($data) {
    if (!property_exists($data, "name") {
        return ValidateResult(false, "Името на курса е задължително поле!");
    }

    $len = strlen($data->{"name"});
    if ($len < 2 || $len > 150) {
        return ValidateResult(false, "Името на курса трябва да е между 2 и 150 символа включително!");
    }
    return ValidateResult(true, null);
}

/*     if (!property_exists($data, "teacher") { */
/*     } */
/*     if (!property_exists($data, "description") || !property_exists($data, "group") || !property_exists($data, "credits")) { */
/*     } */
?>

