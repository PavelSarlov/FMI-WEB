<?php

class ValidateResult {
    function __construct($success, $msg) {
        $this->{"success"} = $success;
        $this->{"msg"} = $msg;
    }
}

function validateName($data) {
    if (!property_exists($data, "name")) {
        return new ValidateResult(false, "Името на курса е задължително поле!");
    }

    $len = count_chars($data->{"name"});
    $min = 2;
    $max = 150;
    if ($len < $min || $len > $max) {
        return new ValidateResult(false, "Името на курса трябва да е между $min и $max символа включително!");
    }
    return new ValidateResult(true, null);
}

function validateTeacher($data) {
    if (!property_exists($data, "teacher")) {
        return new ValidateResult(false, "Името на преподавателя е задължително поле!");
    }

    $len = count_chars($data->{"teacher"});
    $min = 3;
    $max = 200;
    if ($len < $min || $len > $max) {
        return new ValidateResult(false, "Името на преподавателя трябва да е между $min и $max символа включително!");
    }
    return new ValidateResult(true, null);
}

function validateDescription($data) {
    if (!property_exists($data, "description")) {
        return new ValidateResult(false, "Описанието на курса е задължително поле!");
    }

    $len = count_chars($data->{"description"});
    $min = 10;
    if ($len < $min) {
        return new ValidateResult(false, "Описанието на курса трябва да е поне $min, а вие сте въвели $len!");
    }
    return new ValidateResult(true, null);
}

function validateGroup($data) {
    if (!property_exists($data, "group")) {
        return new ValidateResult(false, "Групата е задължително поле!");
    }

    $options = ["М", "ПМ", "ЯКН", "ОКН"];
    if (in_array($data->{"group"}, $options)) {
        return new ValidateResult(false, "Невалидна група, изберете една от {$implode(", ", $options)}!");
    }
    return new ValidateResult(true, null);
}

function validateCredits($data) {
    if (!property_exists($data, "credits")) {
        return new ValidateResult(false, "Кредитите са задължително поле!");
    }

    if ($data->{"credits"} <= 0) {
        return new ValidateResult(false, "Кредитите трябва да са цяло положително число!");
    }
    return new ValidateResult(true, null);
}
?>

