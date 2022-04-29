<?php

class Response {
    public $statusCode;
    public $message;

    public function __construct($statusCode, $message) {
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    public function toJson() {
        http_response_code($this->statusCode);
        header("Content-Type: application/json");
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

?>

