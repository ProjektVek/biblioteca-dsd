<?php
require_once 'db_connection.php';

function selectAllUsers()
{
    $connection = openConnection();
    $query = 'SELECT username, name, type FROM Users;';
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    return $result;
}

function searchUser($search)
{
    $connection = openConnection();
    $query = "SELECT username, name, type FROM Users
            WHERE name LIKE '%" . $search . "%' OR
            username LIKE '%" . $search . "%';";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function checkLogin($username, $password)
{
    $connection = openConnection();
    $query = sprintf("
            SELECT username FROM Users
            WHERE username = '%s' AND
            password LIKE '%s';
            ", $username, $password);

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getUserType($username)
{
    $connection = openConnection();
    $query = "SELECT type FROM Users WHERE
            username ='" . $username . "';";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['type'];
    } else {
        return 0;
    }
}

function checkIfLoggedIn()
{
    if (empty($_SESSION))
        session_start();

    if (empty($_SESSION['username'])) {
        session_destroy();
        header('Location: /src/loginPage.php?login=denied');
        exit;
    } else if (empty($_SESSION['usertype'])) {
        $_SESSION['usertype'] = getUserType($_SESSION['username']);
    }

}

?>