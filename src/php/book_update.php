<?php
include "books_crud.php";
if (isset($_SERVER['HTTP_REFERER'])) {

    $isbn;
    $referer = $_SERVER['HTTP_REFERER'];

    $get = explode("?", $referer);
    $get = end($get);

    $get_splited = explode("&", $get);
    foreach ($get_splited as $get_item) {
        $item_splited = explode("=", $get_item);
        if (reset($item_splited) == "isbn") {
            $isbn = end($item_splited);
        }
    }

    if (!doBookExist($isbn)) {
        header('Location: /src/books.php');
        exit;
    } else {

        if (strlen($_POST['title']) < 1) {
            header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=min-title-size');
            exit;
        } else if (strlen($_POST['title']) > 60) {
            header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=max-isbn-size');
            exit;
        } else if (strlen($_POST['isbn']) < 10) {
            header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=min-isbn-size');
            exit;
        } else if (strlen($_POST['isbn']) > 13) {
            header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=max-isbn-size');
            exit;
        }

        $bookInfo = getBookAllInfo($isbn);
        foreach ($bookInfo as $info) {
            echo $info;
        }
        $wasUpdated = false;

        if ($_POST['title'] != $bookInfo['title']) {
            $queryResult = setTitle($bookInfo['isbn'], $_POST['title']);
            if ($queryResult) {
                $wasUpdated = true;
            } else {
                header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=server-error');
                exit;
            }
        }

        if ($_POST['isbn'] != $isbn) {

            if (!doBookExist($_POST['isbn'])) {
                $queryResult = setISBN($bookInfo['isbn'], $_POST['isbn']);
                if ($queryResult) {
                    $wasUpdated = true;
                } else {
                    header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=server-error');
                    exit;
                }
            } else {
                header('Location: /src/books_edit.php?isbn=' . $isbn . '&message=duplicated');
                exit;
            }
        }

        if ($wasUpdated) {
            header('Location: /src/books_edit.php?isbn=' . $_POST['isbn'] . '&message=success');
            exit;
        } else {
            header('Location: /src/books_edit.php?isbn=' . $isbn);
            exit;
        }
    }


} else {
    header('Location: /src/books.php');
    exit;
}
?>