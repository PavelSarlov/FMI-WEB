<?php

class User {
    private $username;
    private $password;

    function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername() { return $this->username; } 
}

?>
