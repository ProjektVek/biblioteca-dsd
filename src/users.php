<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Consulta de Usuários</title>
    <?php

    include "./php/users_crud.php";
    checkIfLoggedIn();

    if ($_SESSION['usertype'] != 3) {
        header('Location: /src/loginPage.php?login=denied');
        exit;
    }
    ?>
</head>

<body class="bg-green-50">

    <?php

    include "nav_bar.php";
    $result;
    if (empty($_GET['search'])) {
        $result = selectAllUsers();
    } else {
        $result = searchUser($_GET['search']);
    }

    if (mysqli_num_rows($result) > 0) {
        echo <<< END
        <section class="container px-4 mx-auto">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex items-center mt-4 gap-x-3">
                </div>
            </div>

        END;

        if ($_SESSION['usertype']==3) echo <<< END
            <div class="flex justify-end mt-6">
                <button onclick="window.location='./new_user.php';"
                    class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-green-700 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                Cadastrar Usuário
                </button>
            </div>
        END;

        echo <<< END
            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            <div class="flex items-center gap-x-3">
                                                <span>Login</span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Nome
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Tipo
                                        </th>

                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                            Excluir
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
        END;

        while ($row = mysqli_fetch_assoc($result)) {
            $type;
            switch ($row['type']) {
                case 1:
                    $type = "Usuário comum";
                    break;
                case 2:
                    $type = "Funcionário";
                    break;
                case 3:
                    $type = "Administrador";
                    break;
                default:
                    $type = "Erro";
            }
        
            $row_username = $row['username'];
            $row_name = $row['name'];

            echo <<< END
                                    <tr class="transition-colors duration-300 transform hover:bg-gray-100 cursor-pointer" >
                                        <td onclick="window.location='/src/users_edit.php?username=$row_username'"
                                            class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">

                                                <div class="flex items-center gap-x-2">
                                                    <div>
                                                        <h2 class="font-normal text-gray-800 "> $row_username </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td onclick="window.location='/src/users_edit.php?username=$row_username'"
                                            class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap"> $row_name </td>
                                        <td onclick="window.location='/src/users_edit.php?username=$row_username'"
                                            class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap"> $type </td>

                                        <td onclick="window.location='/src/php/delete_user.php?username=$row_username'"
                                             class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap transition-colors transform hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </td>
                                    </tr>
            END;
        }
    } else {
        echo '
        <div class="h-[80vh] w-full flex items-center justify-center">
            <p class="text-4xl">Nenhum usuário encontrado</p>
        </div>
        ';
    }

    ?>

</body>

</html>