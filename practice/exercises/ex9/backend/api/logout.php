<?php

session_start();
session_unset();
session_destroy();
session_write_close();

setcookie("email", "", time() - 1, "/");
setcookie("password", "", time() - 1, "/");
unset($_COOKIE['email']);
unset($_COOKIE['password']);

?>
