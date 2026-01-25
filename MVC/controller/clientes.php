<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/clientes.php");

class ClientesControlador
{
    static function index()
    {
        $clientes = new ClientesModelo();

        $clientes->Seleccionar();

        require_once("view/clientes.php");
    }
// Opción para insertar un cliente. 
    static function Nuevo()
    {
        $opcion  = 'NUEVO';  

        require_once("view/clientesmantenimiento.php");
    }

    static function Exportar()
    {
        // Nos creamos el objeto clientes para acceder a la tabla clientes de la BBDD.
        $clientes = new ClientesModelo();

        // Seleccionamos todos los clientes.
        $clientes->Seleccionar();

        try {
            // Abrimos el fichero clientes.csv en modo escritura.
            $fichero = fopen("clientes.csv", "w");

            // Para cada fila de la tabla...
            foreach ($clientes->filas as $fila) {
                // creamos la línea a exportar y...
                $cadena = "$fila->id#$fila->nombre#$fila->email\n";

                // la guardamos la línea en el fichero.
                fputs($fichero, $cadena);
            }
        } finally {
            // Cerramos el fichero.
            fclose($fichero);
        }

        // Finalmente exportamos el fichero.
        $rutaFichero = 'clientes.csv';
        $fichero = basename($rutaFichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutaFichero));
        header("Content-Disposition: attachment; filename=" . $fichero);

        readfile($rutaFichero);
    }

    //Funcion para crear nuevo cliente
    static function Insertar()
    {
        $cliente = new ClientesModelo();

        $cliente->nombre = $_POST['nombre'];
        $cliente->email  = $_POST['email'];
        $cliente->apellidos = $_POST['apellidos'];
        $cliente->contrasenya  = $_POST['contrasenya'];
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp  = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia  = $_POST['provincia'];
        $cliente->fechaNac  = $_POST['fechaNac'];

        if ($cliente->Insertar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }
    //Opcion para editar
    static function Editar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = $_GET['id'];

        $opcion = 'EDITAR'; // Opción de modificar un cliente. 

        if ($cliente->seleccionar())
            require_once("view/clientesmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }
    //Funcion para modificar
    static function Modificar()
    {
        $cliente = new ClientesModelo();

        $cliente->id     = $_GET['id'];
        $cliente->nombre = $_POST['nombre'];
        $cliente->email  = $_POST['email'];
        $cliente->apellidos = $_POST['apellidos'];
        $cliente->contrasenya  = $_POST['contrasenya'];
        $cliente->direccion = $_POST['direccion'];
        $cliente->cp  = $_POST['cp'];
        $cliente->poblacion = $_POST['poblacion'];
        $cliente->provincia  = $_POST['provincia'];
        $cliente->fechaNac  = $_POST['fechaNac'];


        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar 
        // pero no se haya modificado nada, la función modificar devolverá un cero, 
        // por eso hay que comprobar que no hay error. 
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }
    //Funcion que nos lleva al controlador de Facturas
    static function Verf()
    {

        header("location:" . URLSITE . '?c=facturas');
    }
    //Funcion para borrar
    static function Borrar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = $_GET['id'];

        if ($cliente->Borrar() == 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();

            header("location:" . URLSITE . "view/error.php");
        }
    }
}
