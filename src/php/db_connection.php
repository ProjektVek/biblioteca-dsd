<?php
    
    function openConnection(){
        $db_host = 'localhost';
        $db_user = 'dsdcc8';
        $db_password = 'cc8@unip';
        $db_name = 'Biblioteca';
    
        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
        if(!$connection){
            echo("Connection failed: " . mysqli_connect_error());
            return $connection.mysqli_connect_error();
        } else {
            return $connection;
        }
    }

    function closeConnection($connection){
        mysqli_close($connection);
    }

?>