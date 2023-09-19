<?php
include "users_crud.php";

if (isset($_SERVER['HTTP_REFERER'])) {

    $username;
    $referer = $_SERVER['HTTP_REFERER'];

    $get = explode("?", $referer);
    $get = end($get);

    $get_splited = explode("&", $get);
    foreach ($get_splited as $get_item) {
        $item_splited = explode("=", $get_item);
        if (reset($item_splited) == "username") {
            $username = end($item_splited);
        }
    }

    if(!doUserExist($username)){
        header('Location: /src/users.php');
        exit;
    } else {

        if (strlen($_POST['username'])<2){
            header('Location: /src/users_edit.php?username='.$username.'&message=login-size');
            exit;
        } else if (strlen($_POST['name'])<2){
            header('Location: /src/users_edit.php?username='.$username.'&message=name-size');
            exit;
        } else if ($_POST['password']!=$_POST['passwordConfirmation']) {
            header('Location: /src/users_edit.php?username='.$username.'&message=unmatched');
            exit;
        } else if ($_POST['password']!="" && $_POST['passwordConfirmation']!="") {

            if (strlen($_POST['password'])<8 || strlen($_POST['passwordConfirmation'])<8) {
                header('Location: /src/users_edit.php?username='.$username.'&message=password-size');
                exit;
            }

        }
        
        $userinfo = getUserAllInfo($username);
        $wasUpdated = false;

        if($_POST['username']!=$userinfo['username']){
            $queryResult = setUsername($userinfo['username'], $_POST['username']);
            if($queryResult){
                $wasUpdated = true;
            } else {
                header('Location: /src/users_edit.php?username='.$_POST['username'].'&message=server-error');
                exit;
            }
        }
        if($_POST['name']!=$userinfo['name']){
            $queryResult = setName($userinfo['username'], $_POST['username']);
            if($queryResult){
                $wasUpdated = true;
            } else {
                header('Location: /src/users_edit.php?username='.$_POST['username'].'&message=server-error');
                exit;
            }
        }
        if( ($_POST['password']!="") && ($_POST['password']!=$userinfo['password'])){
            $queryResult = setPassword($userinfo['username'], $_POST['password']);
            if($queryResult){
                $wasUpdated = true;
            } else {
                header('Location: /src/users_edit.php?username='.$_POST['username'].'&message=server-error');
                exit;
            }
        }

        if(isset($_POST['type']) && ($_POST['type'] != $userinfo['type'])) {
            $queryResult = setUserType($userinfo['username'], $_POST['type']);
            if($queryResult){
                $wasUpdated = true;
            } else {
                header('Location: /src/users_edit.php?username='.$_POST['username'].'&message=server-error');
                exit;
            }
        }

         if($wasUpdated){
             header('Location: /src/users_edit.php?username='.$_POST['username'].'&message=success');
             exit;
         } else {
             header('Location: /src/users_edit.php?username='.$username);
             exit;
         }
    }


} else {
    header('Location: /src/users.php');
    exit;
}
?>