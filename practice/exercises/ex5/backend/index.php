<?php

$db = new Db();

if ($_POST['username'] && $_POST['password']) {

    try {

        $con = $db->getConnection();
        $sql = "INSERT INTO users(username, password)
                    VALUES(:username, :password)";
        $args = [
            'username'=>$_POST['username'],
            'password'=>$_POST['password']
        ];
        $res = $con->prepare($sql)->execute($args);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if ($_GET['username']) {

}

?>
