<?php
function openConnection()
{
    $db_host_original = 'database';
    $db_host_replica = 'localhost';
    $db_user = 'dsdcc8';
    $db_password = 'cc8@unip';
    $db_name = 'Biblioteca';

    try{
        $connection = mysqli_connect($db_host_original, $db_user, $db_password, $db_name);
    } catch (Exception $e) {
        error_log("Exception caught: " . $e->getMessage());
    }
    

    if (!$connection) {
        error_log ("Connection with original failed: " . mysqli_connect_error());

        try {
            $connection = mysqli_connect($db_host_replica, $db_user, $db_password, $db_name);
        } catch (Exception $e) {
            error_log("Exception caught: " . $e->getMessage());
        }
        

        if (!$connection) {
            error_log("Connection with replica failed: " . mysqli_connect_error());
            return $connection . mysqli_connect_error();
        } else {
            return $connection;
        }
    } else {
        return $connection;
    }
}

function closeConnection($connection)
{
    mysqli_close($connection);
}

?>