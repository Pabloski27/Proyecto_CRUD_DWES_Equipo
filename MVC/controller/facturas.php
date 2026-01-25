<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/facturas.php");
require_once("model/clientes.php");
require_once("model/l_facturas.php");   // <-- IMPORTANTE: añadir modelo LineasF

class FacturasControlador
{
    static function index()
{
    $factura = new FacturasModelo();
    $factura->Seleccionar();

    // PROTECCIÓN
    if (!is_array($factura->filas) || empty($factura->filas)) {
        $factura->filas = [];
    }

    foreach ($factura->filas as $f) {

        $lineas = new LineaFModelo();
        $lineas->factura_id = $f->id;
        $lineas->SeleccionarPorFactura();

        $base = 0;
        $iva_total = 0;
        $total = 0;

        if (is_array($lineas->filas)) {
            foreach ($lineas->filas as $l) {
                $line_base = $l->cantidad * $l->precio;
                $line_iva = $line_base * ($l->iva / 100);
                $line_total = $line_base + $line_iva;

                $base += $line_base;
                $iva_total += $line_iva;
                $total += $line_total;
            }
        }

        $f->base = $base;
        $f->iva_total = $iva_total;
        $f->total = $total;
    }

    require_once("view/facturas.php");
}


    static function verf()
{
    $factura = new FacturasModelo();

    if (isset($_GET['id_cliente'])) {
        $factura->cliente_id = $_GET['id_cliente'];
        $factura->SeleccionarPorCliente();
    } else {
        $factura->Seleccionar();
    }

    // ⛑️ PROTECCIÓN DESPUÉS DE CARGAR LOS DATOS
    if (!is_array($factura->filas) && !is_object($factura->filas)) {
        $factura->filas = [];
    }

    // =============================
    // CÁLCULO DE TOTALES
    // =============================
    foreach ($factura->filas as $f) {

        $lineas = new LineaFModelo();
        $lineas->factura_id = $f->id;
        $lineas->SeleccionarPorFactura();

        $base = 0;
        $iva_total = 0;
        $total = 0;

        if (is_array($lineas->filas)) {
            foreach ($lineas->filas as $l) {
                $linea_base = $l->cantidad * $l->precio;
                $linea_iva = $linea_base * ($l->iva / 100);
                $line_total = $linea_base + $linea_iva;

                $base += $linea_base;
                $iva_total += $linea_iva;
                $total += $line_total;
            }
        }

        $f->base = $base;
        $f->iva_total = $iva_total;
        $f->total = $total;
    }

    require_once("view/facturas.php");
}


    // ================================
    // TODO LO DEMÁS IGUAL
    // ================================

    static function nuevof()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();
        $opcion = 'NUEVO';
        require_once("view/facturasmantenimiento.php");
    }

    static function Insertar()
    {
        $factura = new FacturasModelo();

        $factura->cliente_id = $_POST['cliente_id'];
        $factura->numero     = $_POST['numero'];
        $factura->fecha      = $_POST['fecha'];

        if ($factura->Insertar() == 1) {
            if (!empty($_POST['id_cliente_volver'])) {
                header("location:" . URLSITE . '?c=facturas&m=verf&id_cliente=' . $_POST['id_cliente_volver']);
            } else {
                header("location:" . URLSITE . '?c=facturas');
            }
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();

        $factura = new FacturasModelo();
        $factura->id = $_GET['id'];
        $opcion = 'EDITAR';

        if ($factura->seleccionar())
            require_once("view/facturasmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $factura = new FacturasModelo();

        $factura->id     = $_GET['id'];
        $factura->cliente_id = $_POST['cliente_id'];
        $factura->numero  = $_POST['numero'];
        $factura->fecha = $_POST['fecha'];

        if (($factura->Modificar() == 1) || ($factura->GetError() == ''))
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $factura = new FacturasModelo();

        $factura->id = $_GET['id'];

        if ($factura->Borrar() == 1)
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
