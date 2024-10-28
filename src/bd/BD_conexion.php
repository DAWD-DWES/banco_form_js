<?php
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;
use App\bd\BD;

// Inicializa el acceso a las variables de entorno

$dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
$dotenv->load();

// Establece conexión a la base de datos PDO
try {
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $database = $_ENV['DB_DATABASE'];
    $usuario = $_ENV['DB_USUARIO'];
    $password = $_ENV['DB_PASSWORD'];
    $pdo = BD::getConexion($host, $port, $database, $usuario, $password);
    return $pdo;
} catch (PDOException $error) {
    echo $blade->run("cnxbderror", compact('error'));
    die;
}