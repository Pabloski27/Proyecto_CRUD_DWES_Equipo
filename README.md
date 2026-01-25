# Proyecto CRUD

Este proyecto es una aplicación web desarrollada en **PHP** que implementa un sistema **CRUD (Create, Read, Update, Delete)** utilizando el patrón de diseño **MVC (Model–View–Controller)**.

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
Clonamos el repositorio:
```bash
git clone
