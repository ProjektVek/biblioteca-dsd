<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Acervo da Biblioteca</title>
    <?php
    include "./php/users_crud.php";
    checkIfLoggedIn();
    ?>
</head>

<body class="bg-green-50">

    <?php

    include "nav_bar.php";
    include "./php/books_crud.php";
    $result;
    if (empty($_GET['search'])) {
        $result = selectAllBooks();
    } else {
        $result = searchBook($_GET['search']);
    }

    if (mysqli_num_rows($result) > 0) {

        echo <<< END
        <section class="container px-4 mx-auto">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex items-center mt-4 gap-x-3">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button onclick="window.location='./new_book.php';"
                    class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                Cadastrar Livro
                </button>
            </div>

            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            <div class="flex items-center gap-x-3">
                                                <span>Título</span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            ISBN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
        END;

        while ($row = mysqli_fetch_assoc($result)) {
            $isbn = $row['isbn'];
            $title = $row['title'];

            echo <<< END
                                    <tr onclick="window.location='/src/books_edit.php?isbn=$isbn';"
                                     class="transition-colors duration-300 transform hover:bg-gray-100 cursor-pointer">
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">

                                                <div class="flex items-center gap-x-2">
                                                    <div>
                                                        <h2 class="font-normal text-gray-800 ">$title</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap">$isbn</td>
                                    </tr>
            END;
        }
    } else {
        echo '
        <div class="h-[80vh] w-full flex items-center justify-center">
            <p class="text-4xl">Nenhum livro encontrado</p>
        </div>
        ';
    }

    ?>

</body>

</html>