<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../dist/output.css" rel="stylesheet" />
  <title>Biblioteca</title>
</head>

<body>
  <div class="bg-white">
    <div class="flex justify-center h-screen">
      <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(./assets/images/library.jpg)">
        <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40"></div>
      </div>

      <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
        <div class="flex-1">
          <div class="text-center">
            <div class="flex justify-center mx-auto">
              <img class="w-auto max-h-32" src="./assets/images/logo.svg" alt="Logo do sistema de Biblioteca" />
            </div>

            <p class="mt-3 text-gray-500">Sistema de Bibliotecas</p>
          </div>

          <div class="mt-8">
            <form method="post" action="./php/login.php">
              <div>
                <label for="email" class="block mb-2 text-sm text-gray-600">Usuário</label>
                <input type="text" name="username" id="username" placeholder="Seu nome de usuário"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
              </div>

              <div class="mt-6">
                <div class="flex justify-between mb-2">
                  <label for="password" class="text-sm text-gray-600">Senha</label>
                </div>

                <input type="password" name="password" id="password" placeholder="Sua senha"
                  class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
              </div>

              <div class="mt-6">
                <input type="submit" value="Entrar" name="btn_login" id="btn_login"
                  class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-green-500 rounded-lg hover:bg-green-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50" />
              </div>
              <?php
              $isLogged = $_GET['login'];
              if ($isLogged === 'invalid') {
                echo '<p class="animated tada text-lg text-red-500 mt-6 text-center">Usuário ou Senha Incorretos</label>';
              } else if ($isLogged === 'denied') {
                echo '<p class="animated tada text-lg text-red-500 mt-6 text-center">Acesso negado!</label>';
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>