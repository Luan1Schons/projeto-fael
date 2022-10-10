<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('./database/MysqliDb.php');
require_once('./database/config.php');

session_start();

if (isset($_SESSION['user'])) {
    header('Location: /dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $db->where('email', $_POST['email']);
    $db->where('password', $_POST['password']);
    $users = $db->getOne('usuarios');


    if (!empty($users)) {
        $_SESSION['user'] = $users;
        header('Location: /dashboard.php');
        exit;
    } else {
        echo 'Nenhum usuário encontrado!<br>';
    }
}

?>
bottom
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/template.css">
</head>

<body>

    <div class="login flex justify-center items-center" style="margin-top: 150px;">

        <div class=" card col-md-4">
            <div class="flex justify-center">
                <h2 class="text-black">AUTENTICAÇÃO</h2>
            </div>

            <div class="login-form flex justify-center">

                <form method="POST" name="submit-form">
                    <div class="box-input flex justify-center">
                        <div class="input">
                            <p>Digite o seu email:</p>
                            <input type="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="input">
                            <p>Digite a sua senha:</p>
                            <input type="password" placeholder="Senha" name="password" required>
                        </div>
                    </div>

                    <div class="flex justify-end box-button-login">
                        <button type="submit" class="btn btn-info">Enviar</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <div class="login-form flex justify-center">
        <p class="text-white">Login utilizado: <br>
            Email: aula@gmail.com<br>
            Senha: 123456
            <br>
    </div>
    <script src="" async defer></script>
</body>

</html>