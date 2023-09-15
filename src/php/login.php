<?php
    #include "db_connection.php";
    include "users_crud.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginResult = checkLogin($username, $password);
    if($loginResult){
        $_SESSION['username'] = $username;
        header('Location: /src/books.php'); exit; 
    } else {
        echo "<script> alert('Usuário ou senha inválida') </script>";
        header('Location: /src/loginPage.php?login=invalid'); exit; 
    }
?>