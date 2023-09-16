<?php
require_once 'db_connection.php';

function selectAllBooks()
{
    $connection = openConnection();
    $query = 'SELECT * FROM Books;';
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    return $result;
}

function searchBook($search)
{
    $connection = openConnection();
    $query = "SELECT * FROM Books
            WHERE title LIKE '%" . $search . "%' OR
            isbn LIKE '%" . $search . "%';";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    return $result;
}
?>