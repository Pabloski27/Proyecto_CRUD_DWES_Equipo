<?php 
require_once("bd.php"); 
 
class ClientesModelo extends BD 
{ 
    // Campos de la tabla. 
    public $id;      
    public $nombre; 
    public $email;
    public $apellidos;
    public $contrasenya;
    public $direccion;
    public $cp;
    public $poblacion;
    public $provincia;
    public $fechaNac;

 
    public $filas = null; 
 
    public function Insertar() 
    { 
        $sql = "INSERT INTO clientes VALUES". 
        
               " (default, '$this->nombre', '$this->email','$this->apellidos','$this->contrasenya', '$this->direccion','$this->cp','$this->poblacion', '$this->provincia','$this->fechaNac')"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Modificar() 
    { 
        $sql = "UPDATE clientes SET" . 
               " nombre='$this->nombre', email='$this->email',apellidos='$this->apellidos', contrasenya='$this->contrasenya',direccion='$this->direccion', cp='$this->cp',poblacion='$this->poblacion', provincia='$this->provincia',fechaNac='$this->fechaNac'" .  
               " WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    } 
 
    public function Borrar() 
    { 
        $sql = "DELETE FROM clientes WHERE id=$this->id"; 
 
        return $this->_ejecutar($sql); 
    }
    
    public function Verf(){

    
      
    }
 
    public function Seleccionar() 
    { 
        $sql = 'SELECT * FROM clientes'; 
 
        // Si me han pasado un id, obtenemos solo el registro indicado. 
        if ($this->id != 0) 
            $sql .= " WHERE id=$this->id"; 
 
        $this->filas = $this->_consultar($sql); 
 
        if ($this->filas == null) 
            return false; 
 
        if ($this->id != 0) 
        { 
            // Guardamos los campos en las propiedades. 
            $this->nombre = $this->filas[0]->nombre; 
            $this->email  = $this->filas[0]->email;
            $this->apellidos = $this->filas[0]->apellidos; 
            $this->contrasenya  = $this->filas[0]->contrasenya; 
            $this->direccion = $this->filas[0]->direccion; 
            $this->cp  = $this->filas[0]->cp; 
            $this->poblacion = $this->filas[0]->poblacion; 
            $this->provincia  = $this->filas[0]->provincia;  
            $this->fechaNac  = $this->filas[0]->fechaNac;  
        } 
 
        return true; 
    } 
} 
?>