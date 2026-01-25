<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/articulos.php");

class articulosControlador
{
    static function index()
    {
        $articulos = new articulosModelo();

        $articulos->Seleccionar();

        require_once("view/articulos.php");
    }

    static function Nuevo()
    {
        $opcion  = 'NUEVO';  // Opción de insertar un cliente. 

        require_once("view/articulosmantenimiento.php");
    }




    static function Insertar()
    {
        $articulo = new articulosModelo();

        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion  = $_POST['descripcion'];
        $articulo->precio = $_POST['precio'];
        $articulo->iva  = $_POST['iva'];

        if ($articulo->Insertar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $articulo = new articulosModelo();

        $articulo->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente. 

        if ($articulo->seleccionar())
            require_once("view/articulosmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $articulo = new articulosModelo();

        $articulo->id     = $_GET['id'];
        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion  = $_POST['descripcion'];
        $articulo->precio = $_POST['precio'];
        $articulo->iva  = $_POST['iva'];


        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar 
        // pero no se haya modificado nada, la función modificar devolverá un cero, 
        // por eso hay que comprobar que no hay error. 
        if (($articulo->Modificar() == 1) || ($articulo->GetError() == ''))
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $articulo = new articulosModelo();

        $articulo->id = $_GET['id'];

        if ($articulo->Borrar() == 1)
            header("location:" . URLSITE . '?c=articulos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }
}
