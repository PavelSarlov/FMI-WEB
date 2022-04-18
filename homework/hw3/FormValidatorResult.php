<?php

class FormValidatorResult {
    private $success;
    private $errors;

    public function __construct() {
        $this->success = true;
        $this->errors = [];
    }

    public function addError($origin, $msg) {
        $this->success = false;
        $this->errors[$origin] = $msg;
    }

    public function toJson() {
        $vars = get_object_vars($this);
        if (count($this->errors) === 0) {
            unset($vars["errors"]);
        }
        return json_encode($vars, JSON_UNESCAPED_UNICODE);
    }
}

?>
