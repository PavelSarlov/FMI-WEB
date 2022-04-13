<?php

class FormValidator {
    public static function validateName($data) {
        if (!property_exists($data, "name")) {
            return "Името на курса е задължително поле!";
        }

        $len = mb_strlen($data->{"name"}, "UTF-8");
        $min = 2;
        $max = 150;
        if ($len < $min || $len > $max) {
            return "Името на курса трябва да е между {$min} и {$max} символа включително, а вие сте въвели {$len}!";
        }
        return null;
    }

    public static function validateTeacher($data) {
        if (!property_exists($data, "teacher")) {
            return "Името на преподавателя е задължително поле!";
        }

        $len = mb_strlen($data->{"teacher"}, "UTF-8");
        $min = 3;
        $max = 200;
        if ($len < $min || $len > $max) {
            return "Името на преподавателя трябва да е между {$min} и {$max} символа включително, а вие сте въвели {$len}!";
        }
        return null;
    }

    public static function validateDescription($data) {
        if (!property_exists($data, "description")) {
            return "Описанието на курса е задължително поле!";
        }

        $len = mb_strlen($data->{"description"}, "UTF-8");
        $min = 10;
        if ($len < $min) {
            return "Описанието на курса трябва да е поне {$min}, а вие сте въвели {$len}!";
        }
        return null;
    }

    public static function validateGroup($data) {
        if (!property_exists($data, "group")) {
            return "Групата е задължително поле!";
        }

        $options = ["М", "ПМ", "ЯКН", "ОКН"];
        $_ = implode(", ", $options);
        if (!in_array($data->{"group"}, $options)) {
            return "Невалидна група, изберете една от {$_}!";
        }
        return null;
    }

    public static function validateCredits($data) {
        if (!property_exists($data, "credits")) {
            return "Кредитите са задължително поле!";
        }

        $cred = $data->{"credits"};
        if ($cred <= 0) {
            return "Кредитите трябва да са цяло положително число, а вие сте въвели {$cred}!";
        }
        return null;
    }
}

?>
