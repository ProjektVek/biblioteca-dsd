<?php
    include "users_crud.php";

    if (strlen($_POST['username'])<2) {
        header('Location: /src/new_user.php?message=min-login-size');
        exit;
    } else if (strlen($_POST['username'])>50){
        header('Location: /src/new_user.php?message=max-login-size');
        exit;
    } else if (strlen($_POST['name']) < 2) {
        header('Location: /src/new_user.php?&message=min-name-size');
        exit;
    } else if (strlen($_POST['name']) > 50) {
        header('Location: /src/new_user.php?&message=max-name-size');
        exit;
    } else if (strlen($_POST['password']) < 8) {
        header('Location: /src/new_user.php?&message=min-password-size');
        exit;
    } else if (strlen($_POST['password']) > 50) {
        header('Location: /src/new_user.php?&message=max-password-size');
        exit;
    } else if (doUserExist($_POST['username'])) {
        header('Location: /src/new_user.php?&message=duplicated');
        exit;
    } else if($_POST['password']!=$_POST['passwordConfirmation']) {
        header('Location: /src/new_user.php?&message=unmatched');
        exit;
    }

    $registerResult = registerUser($_POST['username'], $_POST['name'], $_POST['password'], $_POST['type']);

     if($registerResult){
          header('Location: /src/new_user.php?&message=success');
          exit;
     } else {
          header('Location: /src/new_user.php?&message=server-error');
          exit;
     }
?>