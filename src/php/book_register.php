<?php
    include "books_crud.php";

    if (strlen($_POST['title']) < 1) {
        header('Location: /src/new_book.php?message=min-title-size');
        exit;
    } else if (strlen($_POST['title']) > 60) {
        header('Location: /src/new_book.php?&message=max-isbn-size');
        exit;
    } else if (strlen($_POST['isbn']) < 10) {
        header('Location: /src/new_book.php?&message=min-isbn-size');
        exit;
    } else if (strlen($_POST['isbn']) > 13) {
        header('Location: /src/new_book.php?&message=max-isbn-size');
        exit;
    } if (doBookExist($_POST['isbn'])) {
        header('Location: /src/new_book.php?&message=duplicated');
        exit;
    }

    $registerResult = registerBook($_POST['title'], $_POST['isbn']);

    if($registerResult){
        header('Location: /src/new_book.php?&message=success');
        exit;
    } else {
        header('Location: /src/new_book.php?&message=server-error');
        exit;
    }
?>