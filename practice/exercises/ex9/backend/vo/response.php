<?php

class Response {
    public $statusCode;
    public $body;
    public $timestamp;

    public function __construct($statusCode, $body) {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->timestamp = date(DATE_ATOM);
    }

    public function toJson() {
        http_response_code($this->statusCode);
        header("Content-Type: application/json");
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

?>

