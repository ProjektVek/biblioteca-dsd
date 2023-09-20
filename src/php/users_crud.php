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

function doUserExist($username)
{   
    $connection = openConnection();
    $query = "SELECT username FROM Users
            WHERE username = '".$username."'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}

function getUserAllInfo($username)
{
    $connection = openConnection();
    $query = "SELECT * FROM Users
            WHERE username = '" . $username . "'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    $userinfo = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $userinfo['username'] = $row['username'];
        $userinfo['password'] = $row['password'];
        $userinfo['name'] = $row['name'];
        $userinfo['type'] = $row['type'];
    }
    return $userinfo;
}

function setUsername($username, $newUsername)
{
    $connection = openConnection();
    $query = "UPDATE Users SET username = '" . $newUsername . "'
            WHERE username = '" . $username . "'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function setName($username, $name)
{
    $connection = openConnection();
    $query = "UPDATE Users SET name = '" . $name . "'
            WHERE username = '" . $username . "'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function setPassword($username, $password)
{   
    $connection = openConnection();
    $query = 'UPDATE Users SET password = "'.$password.'" 
              WHERE username = "'.$username.'"; ' ;  

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function setUserType($username, $type)
{
    $connection = openConnection();
    $query = "UPDATE Users SET type = " . $type . "
            WHERE username = '" . $username . "'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function registerUser($username, $name, $password, $type){
    $connection = openConnection();
    $query = <<< END
    INSERT INTO Users VALUES (
        '$username',
        '$password',
        '$name',
        $type
    );
    END;
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function deleteUser($username){
    $connection = openConnection();
    $query = <<< END
    DELETE FROM Users WHERE username = '$username';
    END;

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

?>