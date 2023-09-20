<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Cadastrar usuário</title>
    <?php

    include "./php/users_crud.php";
    checkIfLoggedIn();

    $username = $_GET['username'];
    $name;
    $type;

    if ($_SESSION['usertype'] != 3 && $_SESSION['username'] != $username) {
        header('Location: /src/loginPage.php?login=denied');
        exit;
    }

    ?>
</head>

<body class="bg-green-50">

    <?php include "nav_bar.php"; ?>

    <div class="h-[80vh] w-full flex items-center justify-center">
        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Cadastrar Usuário</h2>

            <form action="/src/php/user_register.php" method="post">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="text-gray-700" for="username">Login</label>
                        <input id="username" name="username" type="text" placeholder="Insira o Login"
                            value="<?php echo $_POST['username']; ?>"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="name">Nome</label>
                        <input id="name" name="name" type="text" placeholder="Insira o Nome"
                            value="<?php echo $_POST['name']; ?>"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="password">Senha</label>
                        <input id="password" name="password" type="password" placeholder="Insira a senha"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="password">Confirmar Senha</label>
                        <input id="passwordConfirmation" name="passwordConfirmation" type="password"
                            placeholder="Confirme a senha"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="type">Tipo</label>
                        <select id="type" name="type"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                            <option value="1" <?php if (!isset($_POST['type']) || $_POST['type'] == 1)
                                echo "selected"; ?>>
                                Usuário comum</option>"
                            <option value="2" <?php if ($_POST['type'] == 2)
                                echo "selected"; ?>>Funcionário</option>"
                            <option value="3" <?php if ($_POST['type'] == 3)
                                echo "selected"; ?>>Administrador</option>"
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div class="flex justify-start mt-6">
                        <?php
                        if ($_GET['message'] == 'success') {
                            echo ('<p class="text-green-600 my-2.5 animated tada">Cadastro realizado com sucesso!</p>');
                        } else if ($_GET['message'] == 'unmatched') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">As senhas não estão iguais</p>');
                        } else if ($_GET['message'] == 'duplicated') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Login já cadastrado!</p>');
                        } else if ($_GET['message'] == 'min-password-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Senha menor que 8 caracteres</p>');
                        } else if ($_GET['message'] == 'max-password-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Senha maior que 50 caracteres</p>');
                        } else if ($_GET['message'] == 'min-login-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Login menor que 2 caracteres</p>');
                        } else if ($_GET['message'] == 'max-login-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Login maior que 50 caracteres</p>');
                        } else if ($_GET['message'] == 'min-name-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Nome menor que 2 caracteres</p>');
                        } else if ($_GET['message'] == 'max-name-size') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Nome maior que 50 caracteres</p>');
                        } else if ($_GET['message'] == 'server-error') {
                            echo ('<p class="text-red-500 my-2.5 animated tada">Erro de servidor</p>');
                        }
                        ?>
                    </div>

                    <div class="flex justify-end mt-6">
                        <input type="submit" value="Cadastrar"
                            class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                    </div>
                </div>

            </form>
        </section>
    </div>
</body>

</html>