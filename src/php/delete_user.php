<?php

include "users_crud.php";

checkIfLoggedIn();

if ($_SESSION['usertype'] != 3){
    header('Location: /src/loginPage.php?login=denied');
    exit;
}

if(isset($_GET['username'])){
    deleteUser($_GET['username']);
}

header('Location: /src/users.php');
exit;

?>