<?php

class Response {
    private $status_code;
    private $msg;

    public function __construct($status_code, $msg) {
        $this->status_code = $status_code;
        $this->msg = $msg;
    }

    public function getStatusCode() {
        return $this->status_code;
    }

    public function getMsg() {
        return $this->msg;
    }

    public function toJson() {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}

?>

