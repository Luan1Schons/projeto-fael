<?php

session_start();
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}


?>
<!DOCTYPE html>
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

    <div class="login">
        <div class="flex justify-center">
            <h2 class="text-white">Administrativo</h2>
        </div>

        <div class="card col-md-4 col-offset-4">

            <div class="flex justify-start">
                <div class="col-md-6">
                    <div class="flex justify-center">
                        <img src="/assets/images/perfil.png" class="perfil" width="120" alt="perfil" />
                    </div>
                </div>
                <div class="col-md-6">
                    <p><b>Dados do usuário:</b></p>
                    <p>Usuário: <?= $_SESSION['user']['name']; ?></p>
                    <p>Email: <?= $_SESSION['user']['email']; ?></p>
                    <a href="/logout.php" class="text-black"><b>Sair</b></a>
                </div>
            </div>
            <br>
            <p>Seja bem vindo(a), aqui você pode criar rotas e veículos para calcular o consumo médio do ponto A ao ponto B.</p>
        </div>

        <div style="margin-top: 60px;">
            <?php require_once('./requires/pages_menu.php'); ?>
        </div>
        <script src="" async defer></script>
</body>

</html>