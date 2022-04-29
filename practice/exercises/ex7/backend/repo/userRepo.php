<?php

require_once "../db/db.php";

class UserRepo {
    public static function getByEmail($email) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM users
                    WHERE email = :email";
        $args = [
            'email'=>$email,
        ];
        $stmt = $con->prepare($sql);
        $stmt->execute($args);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
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
