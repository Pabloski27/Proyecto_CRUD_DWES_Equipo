# Proyecto CRUD

Este proyecto es una aplicación web desarrollada en **PHP** que implementa un sistema **CRUD (Create, Read, Update, Delete)** utilizando el patrón de diseño **MVC (Modelo-Vista-Controlador)**.

Permite gestionar
- Clientes
- Articulos
- Facturas
- Lineas de factura

## Estructura del proyecto

```bash
    MVC
    |
    |--controller
    |      |
    |      |---articulos.php
    |      |---clientes.php
    |      |---facturas.php
    |      |---l-facturas.php
    |--   model
    |      |
    |      |---articulos.php
    |      |---bd.php
    |      |---clientes.php
    |      |---facturas.php
    |      |---l-facturas.php
    |--   view
    |      |--  css
    |      |    |
    |      |    |--- app.css
    |--    |   layout
    |      |    |
    |      |    |--footer.php
    |      |    |--header.php
    |      |    |--menu.php
    |      |    
    |      |---articulos.php
    |      |---articulosmantenimiento.php
    |      |---clientes.php
    |      |---clientesmantenimiento.php
    |      |---error.php
    |      |---facturas.php
    |      |---facturasmantenimiento.php
    |      |---l-facturas.php
    |      |---l-facturasmantenimiento.php
    |
    |--config.php
    |--index.php
```

## Requisitos
- Servidor web XAMPP
- PHP 7.0 o superior
- Mysql
- Navegador Web
  
## Instalación
1. Clonamos el repositorio:
```bash
git clone https://github.com/Pabloski27/Proyecto_CRUD_DWES_Equipo.git
```
2. Instalamos Xampp para el servidor:
   
   Tendremos en cuenta el disco donde lo instalamos para mas adelante
   
4. Copiamos la carpeta MVC:
    
   En windows con Xampp la copiaremos en htdocs que de normal estara en Disco local/xampp/

6. Importamos la base de datos proporcionada:
   
   Estara en este repositorio su nombre es mvc.sql, una vez instalado Xampp y iniciado mysql se accedera a phpmyadmin,le daremos a importar y seleccionaremos el archivo con la base de datos

5.Accederemos desde el navegador: 

   Una vez  iniciado apache y mysql iremos al navegador y iremos a http://localhost/MVC para ver nuestro proyecto

## Acceso y Credenciales

Se debera de configurar la base de datos con los datos datos en el archivo config.php:

- define("SERVIDOR", "localhost"); 
- define("USUARIO", "root"); 
- define("CONTRASENA", ""); 
- define("BASEDATOS", "mvc");
