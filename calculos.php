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

$filter = "";
$bind = [];

if (isset($_POST['search'])) {
    $filter = ' WHERE veiculos.vehicle_name like ? OR veiculos.vehicle_model like ? OR veiculos.vehicle_type like ?';
    $bind = ['%' . $_POST['search'] . '%', '%' . $_POST['search'] . '%', '%' . $_POST['search'] . '%'];
}

$q = 'SELECT 
rotas.id,
rotas.origin_city,
rotas.destiny_city,
rotas.distance,
veiculos.vehicle_name,
veiculos.fuel_price,
veiculos.distance as autonomy_vehicle,
veiculos.vehicle_model,
ROUND(fuel_price / veiculos.distance, 2) as valor_km,
((ROUND(fuel_price / veiculos.distance, 2)) * rotas.distance ) as custo_distancia,
(((ROUND(fuel_price / veiculos.distance, 2)) * rotas.distance) * 2 ) as distancia_ida_volta from veiculos inner join rotas ' . $filter . ' order by veiculos.vehicle_model ASC';

if (count($bind) > 0) {
    $calcules = $db->rawQuery($q, $bind);
} else {
    $calcules = $db->rawQuery($q);
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

        <div class="flex justify-center p-6">

            <div class="card col-md-12 p-6" style="margin-top: 60px;">
                <?php if (!empty(flashMessage())) { ?>
                    <div class="p-3"><?= !empty(flashMessage()); ?></div>
                <?php } ?>

                <div class="flex justify-start items-center">
                    <div class="col-md-12">
                        <div class="flex justify-between items-center">

                            <div class="col-md-8">
                                <p><b>Calculo de veículos:</b></p>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="/calculos.php?page=calculos">
                                    <input type="text" name="search" placeholder="Buscar por nome do veículo">
                            </div>

                        </div>
                        <table width="100%">
                            <tr class=" thead">
                                <th width="2%">#</th>
                                <th width="15%">Origem - Destino</th>
                                <th width="4%">Distância KM</th>
                                <th width="10%">Nome do veículo</th>
                                <th width="4%">Preço combustível</th>
                                <th width="4%">Autonomia KM</th>
                                <th width="13%">Modelo Veículo</th>
                                <th width="5%">Valor KM</th>
                                <th width="5%">Valor Distância</th>
                                <th width="5%">Valor Distância ida e volta</th>
                            </tr>
                            <tbody class="calcule">
                                <?php if (!empty($calcules)) { ?>
                                    <?php foreach ($calcules as $calcule) { ?>
                                        <tr>
                                            <td class="text-center"><?= $calcule['id']; ?></td>
                                            <td class="flex items-center"><?= $calcule['origin_city']; ?> <svg xmlns="http://www.w3.org/2000/svg" class="text-green" height="30" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                                    <path strokeLinecap="round" strokeLinejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                                </svg>
                                                <?= $calcule['destiny_city']; ?></td>
                                            <td><?= $calcule['distance']; ?> KM</td>
                                            <td class="text-white"><?= $calcule['vehicle_name']; ?></td>
                                            <td class="text-center text-white">R$ <?= $calcule['fuel_price']; ?></td>
                                            <td class="text-center"><?= $calcule['autonomy_vehicle']; ?> km/l</td>
                                            <td><?= $calcule['vehicle_model']; ?></td>
                                            <td class="text-center">R$ <?= $calcule['valor_km']; ?></td>
                                            <td class="text-center">R$ <?= $calcule['custo_distancia']; ?></td>
                                            <td class="text-center text-white">R$ <?= $calcule['distancia_ida_volta']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="" async defer></script>
</body>

</html>