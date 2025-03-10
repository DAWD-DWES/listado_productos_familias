<?php

session_start();

require_once '../vendor/autoload.php';
require_once '../src/error_handler.php';

use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\Dao\ProductoDao;

$views = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

// Establece conexión a la base de datos PDO
try {
    $bd = BD::getConexion();
} catch (Exception $error) {
    echo $blade->run("cnxbderror", compact('error'));
    die;
}

$productoDao = new ProductoDao($bd);

if (isset($_SESSION['usuario'])) {
    $nombre = $_SESSION['usuario'];
    try {
        $productos = $productoDao->recuperaTodo();
    } catch (PDOException $ex) {
        error_log("Error al recuperar información de productos " . $ex->getMessage());
        $productos = [];
    }
    echo $blade->run('productos', compact('nombre', 'productos'));
} else {
    echo $blade->run('portada');
}