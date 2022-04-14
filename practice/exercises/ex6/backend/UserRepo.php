<?php

require_once("db.php");

class UserRepo {
    public static function getByUsername($username) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "SELECT * FROM user
                    WHERE username = :username";
        $args = [
            'username'=>$username,
        ];
        $stmt = $con->prepare($sql);
        $stmt->execute($args);
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetch();
    }

    public static function createUser($username, $password) {
        $db = new Db();
        $con = $db->getConnection();
        $sql = "INSERT INTO users(username, password)
                    VALUES (:username, :password)";
        $args = [
            'username'=>$username,
            'password'=>password_hash($password, PASSWORD_DEFAULT)
        ];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($args);

        return $res;
    }
}

?>
