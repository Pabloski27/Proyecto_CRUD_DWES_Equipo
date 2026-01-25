<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/l_facturas.php");
require_once("model/facturas.php");
require_once("model/clientes.php");
require_once("model/articulos.php");

class LineaFControlador
{
    static function index()
    {
        $l_factura = new LineaFModelo();

        $l_factura->Seleccionar();

        require_once("view/l_facturas.php");
    }

    static function nueva_l()
    {
        $facturas = new FacturasModelo();
        $facturas->Seleccionar();

        $articulos = new articulosModelo();
        $articulos->Seleccionar();

        $l_factura = new LineaFModelo();

        // SI SE HA SELECCIONADO UN ARTICULO para autocompletar
        if (isset($_POST['accion']) && $_POST['accion'] == 'seleccionar' && !empty($_POST['articulo_id'])) {
            $articulo = new articulosModelo();
            $articulo->id = $_POST['articulo_id'];

            if ($articulo->Seleccionar()) {
                $l_factura->referencia  = $articulo->referencia;
                $l_factura->descripcion = $articulo->descripcion;
                $l_factura->precio      = $articulo->precio;
                $l_factura->iva         = $articulo->iva;
            }
        }

        $opcion  = 'Nueva Linea';
        $factura_id_actual = $_GET['id_factura'] ?? '';

        require_once("view/l_facturasmantenimiento.php");
    }



    static function verl()
    {
        $id_facturas = ($_GET['id_factura']);

        $factura = new FacturasModelo();
        $factura->id = $id_facturas;
        $factura->Seleccionar();

        $cliente = new ClientesModelo();
        $cliente->id = $factura->cliente_id;
        $cliente->Seleccionar();

        $l_factura = new LineaFModelo();
        $l_factura->factura_id = $id_facturas;
        $l_factura->SeleccionarPorFactura();

        // PROTECCIÓN
        if (!is_array($l_factura->filas)) {
            $l_factura->filas = [];
        }

        // CALCULAR SUMA DE IMPORTES
        $total_importe = 0;
        foreach ($l_factura->filas as $linea) {
            $total_importe += $linea->importe;
        }

        // CALCULAR BASE + IVA
        $base = 0;
        $iva_total = 0;

        foreach ($l_factura->filas as $linea) {
            $base += $linea->precio;
            $iva_total += $linea->iva;
        }

        // Total final
        $total = $base + $iva_total;

        require_once("view/l_facturas.php");
    }






    static function Insertar()
    {
        $l_factura = new LineaFModelo();

        // Convertir a float para evitar error
        $precio = floatval($_POST["precio"] ?? 0);
        $cantidad = floatval($_POST["cantidad"] ?? 0);
        $iva = floatval($_POST["iva"] ?? 0);

        $importe = $cantidad * $precio * (1 + $iva / 100.0);

        $l_factura->factura_id = $_POST['factura_id'];
        $l_factura->referencia  = $_POST['referencia'];
        $l_factura->descripcion = $_POST['descripcion'];
        $l_factura->cantidad = $cantidad;
        $l_factura->precio  = $precio;
        $l_factura->iva = $iva;
        $l_factura->importe = $importe;

        if ($l_factura->Insertar() == 1)
            header("location:" . URLSITE . "?c=l_facturas&m=verl&id_factura=" . $l_factura->factura_id);
        else {
            $_SESSION["CRUDMVC_ERROR"] = $l_factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }


   static function Editar()
{
    $facturas = new FacturasModelo();
    $facturas->Seleccionar();

    $l_factura = new LineaFModelo();
    $l_factura->id = $_GET['id'];

    $articulos = new articulosModelo();
    $articulos->Seleccionar();

    $opcion = 'EDITAR'; 

    if ($l_factura->seleccionar()) {
        $factura_id_actual = $l_factura->factura_id; // ✅ PASARLO A LA VISTA
        require_once("view/l_facturasmantenimiento.php");
    } else {
        $_SESSION["CRUDMVC_ERROR"] = $l_factura->GetError();
        header("location:" . URLSITE . "view/error.php");
    }
}


    static function Modificar()
{
    $l_factura = new LineaFModelo();

    $l_factura->id          = $_GET['id'];
    $l_factura->factura_id  = $_POST['factura_id'];
    $l_factura->referencia  = $_POST['referencia'];
    $l_factura->descripcion = $_POST['descripcion'];
    $l_factura->cantidad    = $_POST['cantidad'];
    $l_factura->precio      = $_POST['precio'];
    $l_factura->iva         = $_POST['iva'];
    $l_factura->importe     = $_POST['cantidad'] * $_POST['precio'] * (1 + $_POST['iva'] / 100.0);

    // 🔹 Asignar el articulo_id también
    $l_factura->articulo_id = $_POST['articulo_id'];

    if (($l_factura->Modificar() == 1) || ($l_factura->GetError() == ''))
        header("location:" . URLSITE . "?c=l_facturas&m=verl&id_factura=" . $l_factura->factura_id);
    else {
        $_SESSION["CRUDMVC_ERROR"] = $l_factura->GetError();
        header("location:" . URLSITE . "view/error.php");
    }
}


    static function Borrar()
    {
        $l_factura = new LineaFModelo();

        // Primero obtengo la línea para saber factura_id
        $l_factura->id = $_GET['id'];
        $l_factura->Seleccionar();

        $factura_id = $l_factura->factura_id;

        // Ahora sí borro
        if ($l_factura->Borrar() == 1) {
            header("location:" . URLSITE . "?c=l_facturas&m=verl&id_factura=" . $factura_id);
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $l_factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
