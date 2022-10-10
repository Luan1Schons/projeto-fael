<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('./database/MysqliDb.php');
require_once('./database/config.php');
require_once('./helpers/flash_session.php');

session_start();
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$routes = $db->get('veiculos');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $data = [
        'vehicle_name' => strip_tags($_POST['vehicle_name']),
        'fuel' => strip_tags($_POST['fuel']),
        'distance' => strip_tags($_POST['distance']),
        'fuel_price' => strip_tags($_POST['fuel_price']),
        'vehicle_type' => strip_tags($_POST['vehicle_type']),
        'vehicle_model' => strip_tags($_POST['vehicle_model']),
    ];


    $routeInsert = $db->insert('veiculos', $data);

    if ($routeInsert) {
        $routes = $db->get('veiculos');
        $_SESSION['message'] = 'Veículo cadastrado com sucesso!';
    } else {
        $_SESSION['message'] = $db->getLastError();
    }
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
    <title>Sistema - Rotas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/template.css">
</head>

<body>

    <div class="login">

        <?php require_once('./requires/pages_menu.php'); ?>

        <div class="flex justify-center">
            <div class="card col-md-4 p-6" style="margin-top: 60px;">
                <?php if (!empty(flashMessage())) { ?>
                    <div class="p-3"><?= !empty(flashMessage()); ?></div>
                <?php } ?>

                <div class="flex justify-start items-center">
                    <div class="col-md-6">
                        <div class="flex justify-center">
                            <img src="/assets/images/suv.png" class="perfil" width="120" alt="perfil" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p><b>Criar novo veículo:</b></p>

                        <form method="POST" name="submit-form">
                            <div class="box-input flex justify-start">

                                <div class="input-1">
                                    <span>Nome do carro:</span>
                                    <input type="text" placeholder="Modelo" name="vehicle_name" required>
                                </div>

                                <div class="input-1">
                                    <span>Modelo do veículo:</span>
                                    <input type="text" placeholder="Modelo" name="vehicle_model" required>
                                </div>

                                <div class="mt-20">

                                    <div class="input-1">
                                        <span>Tipo do veículo:</span>
                                        <select name="vehicle_type" id="vehicle_type">
                                            <option value="car">Carro</option>
                                            <option value="truck">Caminhão</option>
                                            <option value="airplane">Avião</option>
                                            <option value="bike">Moto</option>
                                        </select>
                                    </div>

                                    <div class="input-1">
                                        <span>Tipo do combustível:</span>
                                        <select name="fuel" id="fueld">
                                            <option value="fuel_diesel">Diesel</option>
                                            <option value="fuel_comun">Gasolina Comum</option>
                                            <option value="fuel_airplane">Gasolina Aditivada</option>
                                            <option value="fuel_premium">Gasolina Premium</option>
                                            <option value="fuel_formuled">Gasolina Formulada</option>
                                            <option value="fuel_airplane">Gasolina de aviação</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-1 mt-20">
                                    <span>Autonomia em KM:</span>
                                    <input type="number" name="distance" min="1.0" step="any" oninput="validity.valid||(value='');" required>
                                </div>

                                <div class="input-1">
                                    <span>Preço do combustível:</span>
                                    <input type="number" name="fuel_price" min="1.50" step="any" oninput="validity.valid||(value='');" name="fuel_price" required>
                                </div>

                            </div>

                            <div class="flex justify-end box-button-save">
                                <button type="submit" class="btn btn-success mt-20">Criar novo veículo</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="card col-md-4 p-6" style="margin-top: 60px;">
                <?php if (!empty(flashMessage())) { ?>
                    <div class="p-3"><?= !empty(flashMessage()); ?></div>
                <?php } ?>

                <div class="flex justify-start items-center">
                    <div class="col-md-12">
                        <p><b>Veículos criados:</b></p>
                        <table width="100%">
                            <tr class=" thead">
                                <th width="10%">#</th>
                                <th width="24%">Carro</th>
                                <th width="24%">Modelo</th>
                                <th width="16%">Tipo Combustível</th>
                                <th width="16%">Preço combustível</th>
                                <th width="16%">Autonomia KM</th>
                                <th width="8%">Ações</th>
                            </tr>

                            <?php if (!empty($routes)) { ?>
                                <?php foreach ($routes as $route) { ?>
                                    <tr>
                                        <td class="text-center"><?= $route['id']; ?></td>
                                        <td><?= $route['vehicle_name']; ?></td>
                                        <td><?= $route['vehicle_model']; ?></td>
                                        <td><?= $route['fuel']; ?></td>
                                        <td><?= $route['fuel_price']; ?></td>
                                        <td><?= $route['distance']; ?> KM</td>
                                        <td class="text-center">
                                            <a href="/vehicle_delete.php?id=<?= $route['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="25" class="text-red" viewBox="0 0 24 24" fill="currentColor" className="w-6 h-6">
                                                    <path fillRule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clipRule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="" async defer></script>
</body>

</html>