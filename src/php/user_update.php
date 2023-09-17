<?php
    if(isset($_SERVER['HTTP_REFERER'])){
      echo  "<script>alert('".$_SERVER['HTTP_REFERER']."')</script>";
    } else {
        header('Location: /src/users.php');
        exit;
    }
?>