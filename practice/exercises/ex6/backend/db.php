<?php

class Db {
    private $connection;

    public function __construct() {
        $dbHost = "localhost";
        $dbAccent = "mysql";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "products_store";

        $this->connection = new PDO("$dbAccent:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    }

    public function getConnection() { return $this->connection; }
}

?>
