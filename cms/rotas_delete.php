<?php
session_start();

require_once('./database/MysqliDb.php');
require_once('./database/config.php');
require_once('./helpers/flash_session.php');

if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

if (!empty($_GET['id'])) {
    $db->where('id', $_GET['id']);
    $db->delete('rotas');
    $_SESSION['message'] = 'Rota apagada com sucesso!';
}

header('Location: /rotas.php');
exit();
