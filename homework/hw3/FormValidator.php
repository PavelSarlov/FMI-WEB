<?php

require "FormValidatorResult.php";

class FormValidator {
    private $result;

    public function __construct() {
        $this->result = new FormValidatorResult();
    }

    public function getResult() {
        return $this->result;
    }

    public function validateName($data) {
        $prop = "name";

        if (!isset($data[$prop])) {
            $this->result->addError($prop, "Името на курса е задължително поле");
            return;
        }

        $len = mb_strlen($data[$prop], "UTF-8");
        $min = 2;
        $max = 150;
        if ($len < $min || $len > $max) {
            $this->result->addError($prop, "Името на курса трябва да е между {$min} и {$max} символа включително, а вие сте въвели {$len}");
        }
    }

    public function validateTeacher($data) {
        $prop = "teacher";

        if (!isset($data[$prop])) {
            $this->result->addError($prop, "Името на преподавателя е задължително поле");
            return;
        }

        $len = mb_strlen($data[$prop], "UTF-8");
        $min = 3;
        $max = 200;
        if ($len < $min || $len > $max) {
            $this->result->addError($prop, "Името на преподавателя трябва да е между {$min} и {$max} символа включително, а вие сте въвели {$len}");
        }
    }

    public function validateDescription($data) {
        $prop = "description";

        if (!isset($data[$prop])) {
            $this->result->addError($prop, "Описанието на курса е задължително поле");
            return;
        }

        $len = mb_strlen($data[$prop], "UTF-8");
        $min = 10;
        if ($len < $min) {
            $this->result->addError($prop, "Описанието на курса трябва да е поне {$min} символа, а вие сте въвели {$len}");
        }
    }

    public function validateGroup($data) {
        $prop = "group";

        if (!isset($data[$prop])) {
            $this->result->addError($prop, "Групата е задължително поле");
            return;
        }

        $options = ["М", "ПМ", "ЯКН", "ОКН"];
        $_ = implode(", ", $options);
        if (!in_array($data[$prop], $options)) {
            $this->result->addError($prop, "Невалидна група, изберете една от {$_}");
        }
    }

    public function validateCredits($data) {
        $prop = "credits";

        if (!isset($data[$prop])) {
            $this->result->addError($prop, "Кредитите са задължително поле");
            return;
        }

        $cred = $data[$prop];
        if (filter_var($cred, FILTER_VALIDATE_INT) === false || $cred <= 0) {
            $this->result->addError($prop, "Кредитите трябва да са цяло положително число, а вие сте въвели {$cred}");
        }
    }
}

?>
