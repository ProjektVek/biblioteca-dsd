<?php
#include "db_connection.php";
include "users_crud.php";

$username = $_POST['username'];
$password = $_POST['password'];

$loginResult = checkLogin($username, $password);
if ($loginResult) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['usertype'] = getUserType($username);
    header('Location: /src/books.php');
    exit;
} else {
    header('Location: /src/loginPage.php?login=invalid');
    exit;
}
?>