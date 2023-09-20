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

function getBook($isbn){
    $connection = openConnection();
    $query = "SELECT * FROM Books
            WHERE isbn = '".$isbn."' ;";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    return $result;
}

function doBookExist($isbn)
{   
    if (mysqli_num_rows(getBook($isbn)) == 1) {
        return true;
    } else {
        return false;
    }
}

function getBookAllInfo($isbn)
{
    $connection = openConnection();
    $query = "SELECT * FROM Books
            WHERE isbn = '" . $isbn . "'; ";

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    $bookinfo = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bookinfo['isbn'] = $row['isbn'];
        $bookinfo['title'] = $row['title'];
    }
    return $bookinfo;
}

function setISBN($isbn, $newISBN)
{   
    $connection = openConnection();
    $query = "UPDATE Books SET isbn = '" . $newISBN . "'
            WHERE isbn = '" . $isbn . "'; " ;

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function setTitle($isbn, $title)
{
    $connection = openConnection();
    $query = "UPDATE Books SET title = '" . $title . "'
            WHERE isbn = '" . $isbn . "'; ";
            
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}

function registerBook($title, $isbn){
    $connection = openConnection();
    $query = <<< END
    INSERT INTO Books VALUES (
        '$title',
        '$isbn',
        NULL
    );
    END;

    $result = mysqli_query($connection, $query);
    mysqli_close($connection);

    return $result;
}
?>