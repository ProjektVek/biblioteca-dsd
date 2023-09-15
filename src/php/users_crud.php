<?php
    require_once 'db_connection.php';

    function selectAllUsers(){
        $connection = openConnection();
        $query = 'SELECT * FROM Users;';
        $result = mysqli_query($connection, $query);

        mysqli_close($connection);
        return $result;
    }

    function searchUser($search){
        $connection = openConnection();
        $query = "SELECT * FROM Users
            WHERE name LIKE '%".$search."%' OR
            username LIKE '%".$search."%';";
            
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        
        return $result;
    }

    function checkLogin($username, $password){
        $connection = openConnection();
        $query = sprintf("
            SELECT * FROM Users
            WHERE username = '%s' AND
            password LIKE '%s';
            ", $username, $password);
            
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);

        if(mysqli_num_rows($result)>0){
            return true;
        } else {
            return false;
        }
    }
?>


