<?php

require_once '../vendor/autoload.php';
require_once '../src/error_handler.php';

// Establece conexión a la base de datos PDO
$pdo = require_once '../src/BD/BD_conexion.php';


use App\bd\BD;
use App\dao\{
    OperacionDAO,
    CuentaDAO,
    ClienteDAO
};
use App\modelo\{
    Banco
};
use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;

// Inicializa el acceso a las variables de entorno

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$vistas = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($vistas, $cache, BladeOne::MODE_DEBUG);
$blade->setBaseURL("http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/");

$clienteDAO = new ClienteDAO($pdo, $cuentaDAO);

$banco = new Banco("Midas");
$banco->setClienteDAO($clienteDAO);


