<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("config.php");
require_once("controller/clientes.php");
require_once("controller/facturas.php");
require_once("controller/l_facturas.php");
require_once("controller/articulos.php");

// Controlador solicitado
$controlador = isset($_GET['c']) ? strtolower($_GET['c']) : 'clientes';

// Método solicitado
$metodo = isset($_GET['m']) ? strtolower($_GET['m']) : 'index';

// Selección del controlador real
switch ($controlador) {
    case 'clientes':
        $clase = 'ClientesControlador';
        break;

    case 'facturas':
        $clase = 'FacturasControlador';
        break;

    case 'l_facturas':
        $clase = 'LineaFControlador';
        break;

    case 'articulos':
        $clase = 'articulosControlador';
        break;

    default:
        $clase = 'ClientesControlador';
        break;
}

// Si el método existe dentro de la clase, lo ejecutamos
if (method_exists($clase, $metodo)) {
    $clase::$metodo();
} else {
    // Si no existe, carga el index del controlador solicitado
    $clase::index();
}
