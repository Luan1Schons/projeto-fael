<?php
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "123321";
$dbname = "avaliacao_fael";

try {
    $db = new MysqliDb($dbhost, $dbusername, $dbpassword, $dbname);
} catch (Exception $e) {
    die($e->getMessage());
}
