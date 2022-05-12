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

    public static function getAllByUser($userId) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT products.* FROM user_products\n" .
            "INNER JOIN products ON products.id = user_products.product_id\n" .
            "WHERE user_id = :userId";
        $stmt = $con->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public static function getById($id) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM products WHERE id = :id";
        $args = [
            'id' => $id
        ];
        $stmt = $con->prepare($sql);
        $stmt->execute($args);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchOne();
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
