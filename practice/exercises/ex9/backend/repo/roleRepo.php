<?php

require_once "../db/db.php";

class ReloRepo {
    public static function getById($id) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM user_roles\n" .
            "WHERE id = :id";
        $args = [
            'id'=>$id
        ];
        $stmt = $con->prepare($sql);
        $stmt->execute($args);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();

    }

    public static function getAll() {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM user_roles";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public static function createUser($email, $password) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "INSERT INTO users(email, password)
                    VALUES (:email, :password)";
        $args = [
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT)
        ];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($args);

        return $res;
    }
}

?>
