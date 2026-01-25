<?php

require_once("bd.php"); 

class LineaFModelo extends BD {

     // Campos de la tabla. 
    public $id;      
    public $factura_id; 
    public $articulo_id;
    public $referencia;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $iva;
    public $importe;

 
    public $filas = null; 
 
    public function Insertar() 
    { 
        $sql = "INSERT INTO lineasf VALUES". 
        
               " (default, '$this->factura_id', '$this->referencia','$this->descripcion','$this->cantidad', '$this->precio','$this->iva','$this->importe','$this->articulo_id')"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Modificar() 
    { 
        $sql = "UPDATE lineasf SET " . 
               " factura_id='$this->factura_id', referencia='$this->referencia', descripcion='$this->descripcion', cantidad='$this->cantidad', precio='$this->precio', iva='$this->iva', importe='$this->importe', articulo_id='$this->articulo_id'" .  
               " WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Borrar() 
    { 
        $sql = "DELETE FROM lineasf WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Seleccionar() 
    { 
        $sql = 'SELECT * FROM lineasf'; 
 
        // Si me han pasado un id, obtenemos solo el registro indicado. 
        if ($this->id != 0) 
            $sql .= " WHERE id=$this->id"; 
 
        $this->filas = $this->_consultar($sql); 
 
        if ($this->filas == null) 
            return false; 
 
        if ($this->id != 0) 
        { 
            // Guardamos los campos en las propiedades. 
            $this->factura_id = $this->filas[0]->factura_id; 
            $this->articulo_id = $this->filas[0]->articulo_id;
            $this->referencia  = $this->filas[0]->referencia;
            $this->descripcion = $this->filas[0]->descripcion; 
            $this->cantidad = $this->filas[0]->cantidad; 
            $this->precio  = $this->filas[0]->precio;
            $this->iva = $this->filas[0]->iva; 
            $this->importe = $this->filas[0]->importe; 
        
        } 
 
        return true; 
    } 

    public function SeleccionarPorFactura() 
{ 
    $sql = "SELECT * FROM lineasf WHERE factura_id = $this->factura_id"; 
    $this->filas = $this->_consultar($sql); 

    return $this->filas != null; 
}


}