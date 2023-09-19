<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Editar Livro</title>
    <?php

    include "./php/users_crud.php";
    include "./php/books_crud.php";

    checkIfLoggedIn();

    $isbn = $_GET['isbn'];
    $title;

    if ($_SESSION['usertype'] != 2 && $_SESSION['usertype'] != 3) {
        header('Location: /src/loginPage.php?login=denied');
        exit;
    } else if (empty($isbn) || !doBookExist($isbn)) {
        header('Location: /src/books.php');
        exit;
    } else {
        $query = getBook($isbn);
        $result = mysqli_fetch_assoc($query);
        
        $title = $result['title'];
    }
    ?>
</head>

<body class="bg-green-50">

    <?php include "nav_bar.php"; ?>

    <div class="h-[80vh] w-full flex items-center justify-center">
        <section class="w-[35em] p-6 mx-auto bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Editar Livro</h2>

            <form action="/src/php/book_update.php" method="post">
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="title">Título</label>
                        <input id="title" name="title" type="text" maxlength="60" value="<?php echo $title ?>"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="isbn">ISBN</label>
                        <input id="isbn" name="isbn" type="text" maxlength="13" value="<?php echo $isbn ?>"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div class="flex justify-start mt-6">
                    <?php
                    if ($_GET['message']=='success') { echo('<p class="text-green-600 my-2.5 animated tada">Alteração realizada com sucesso!</p>'); }
                    else if ($_GET['message']=='min-title-size') { echo('<p class="text-red-500 my-2.5 animated tada">Título menor que 1 caracter</p>'); }
                    else if ($_GET['message']=='max-title-size') { echo('<p class="text-red-500 my-2.5 animated tada">Título maior que 60 caracteres</p>'); }
                    else if ($_GET['message']=='min-isbn-size') { echo('<p class="text-red-500 my-2.5 animated tada">ISBN menor que 10 caracteres</p>'); }
                    else if ($_GET['message']=='max-isbn-size') { echo('<p class="text-red-500 my-2.5 animated tada">ISBN maior que 13 caracteres</p>'); }
                    else if ($_GET['message']=='duplicated') { echo('<p class="text-red-500 my-2.5 animated tada">ISBN já existente</p>'); }
                    else if ($_GET['message']=='server-error') { echo('<p class="text-red-500 my-2.5 animated tada">Erro de servidor</p>'); }
                    ?>
                    </div>

                    <div class="flex justify-end mt-6">
                        <input type="submit" value="Salvar"
                            class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                    </div>
                </div>

            </form>
        </section>
    </div>
</body>

</html>