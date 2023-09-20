<?php

include "users_crud.php";
include "books_crud.php";

checkIfLoggedIn();

if ($_SESSION['usertype'] != 3 && $_SESSION['usertype'] != 2 ){
    header('Location: /src/loginPage.php?login=denied');
    exit;
}

if(isset($_GET['isbn'])){
    deleteBook($_GET['isbn']);
}

 header('Location: /src/books.php');
 exit;

?>