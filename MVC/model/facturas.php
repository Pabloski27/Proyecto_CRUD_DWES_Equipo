<?php

require_once("bd.php"); 

class FacturasModelo extends BD {

     // Campos de la tabla. 
    public $id;      
    public $cliente_id;
    public $nombre;
    public $numero;
    public $fecha;

 
    public $filas = null; 
 
    public function Insertar() 
    { 
        $sql = "INSERT INTO facturas VALUES". 
        
               " (default, '$this->cliente_id','$this->numero','$this->fecha')"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Modificar() 
    { 
        $sql = "UPDATE facturas SET" . 
               " cliente_id='$this->cliente_id', numero='$this->numero',fecha='$this->fecha'" .  
               " WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Borrar() 
    { 
        $sql = "DELETE FROM facturas WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    } 
 
   public function Seleccionar() 
{ 
    // Hacemos un JOIN para traer el nombre del cliente
    $sql = "SELECT f.*, c.nombre AS cliente_nombre 
            FROM facturas f
            INNER JOIN clientes c ON f.cliente_id = c.id";

    // Si me han pasado un id, obtenemos solo el registro indicado.
    if ($this->id != 0) 
        $sql .= " WHERE f.id = $this->id"; 

    $this->filas = $this->_consultar($sql); 

    if ($this->filas == null) 
        return false; 

    if ($this->id != 0) 
    { 
        // Guardamos los campos en las propiedades.
        $this->cliente_id = $this->filas[0]->cliente_id;
        $this->numero = $this->filas[0]->numero;
        $this->fecha = $this->filas[0]->fecha;
    } 

    return true; 
}

public function SeleccionarPorCliente()
{
    $sql = "SELECT f.*, c.nombre AS cliente_nombre
            FROM facturas f
            INNER JOIN clientes c ON f.cliente_id = c.id
            WHERE f.cliente_id = $this->cliente_id";

    $this->filas = $this->_consultar($sql);

    return $this->filas != null;
}



}