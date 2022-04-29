<?php

require_once "../db/db.php";

class ProductRepo {
    public static function getAll() {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM products";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public static function createProduct($name, $type) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "INSERT INTO products(name, type)
                    VALUES (:name, :type)";
        $args = [
            'name'=>$name,
            'type'=>$type
        ];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($args);

        return $res;
    }
}

?>
