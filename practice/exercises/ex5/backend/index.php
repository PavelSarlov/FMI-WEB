<?php

include "db.php";

$db = new Db();

$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data->{"username"} && $data->{"password"}) {
    $username = $data->{"username"};
    $password_hash = hash('sha256', $data->{"password"});

    try {
        $con = $db->getConnection();
        $sql = "SELECT * FROM user
                    WHERE username = :username AND password = :password";
        $args = [
            'username'=>$username,
            'password'=>$password_hash
        ];
        $stmt = $con->prepare($sql);
        $stmt->execute($args);
        $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($res > 0) {
            while($row = $stmt->fetch()) {
                echo implode(" ", $row);
            }
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
