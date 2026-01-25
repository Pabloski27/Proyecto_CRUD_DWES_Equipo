<?php require("layout/header.php"); ?> 
<h1>Lineas Facturas</h1>
<div class="dos-columnas">
    <p>Cliente: <?php echo $cliente->nombre; ?> </p>
    <p>Base: <?php echo number_format($base, 2); ?>€</p>
    <p>Fecha: <?php echo $factura->fecha; ?></p>  
    <p>Importe: <?php echo number_format($iva_total, 2); ?>€</p>
    <p>NºFactura: <?php echo $l_factura->factura_id; ?> </p>
    <p>Total: <?php echo number_format($total_importe, 2); ?>€</p>
</div>
<style>
    .dos-columnas {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* dos columnas */
        gap: 10px;
        /* espacio entre elementos */
    }
</style> <br />
<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-left">
            <th>Id</th>
            <th>factura_id</th>
            <th>referencia</th>
            <th>descripcion</th>
            <th>cantidad</th>
            <th>precio</th>
            <th>iva</th>
            <th>importe</th>
            <th></th>
        </tr>
    </thead>
    <tbody> <?php if ($l_factura->filas) : foreach ($l_factura->filas as $fila) : ?> <tr>
                    <td style="text-align: left; width: 5%;"><?php echo $fila->id; ?></td>
                    <td><?php echo $fila->factura_id; ?></td>
                    <td><?php echo $fila->referencia; ?></td>
                    <td><?php echo $fila->descripcion; ?></td>
                    <td><?php echo $fila->cantidad; ?></td>
                    <td><?php echo $fila->precio; ?></td>
                    <td><?php echo $fila->iva; ?></td>
                    <td><?php echo $fila->importe; ?></td>
                    <td style="text-align: right; width: 50%;"> <a href="index.php?c=l_facturas&m=editar&id=<?php echo $fila->id; ?>"> <button type="button" class="btn btn-success">Editar</button></a> <a href="index.php?c=l_facturas&m=borrar&id=<?php echo $fila->id; ?>"> <button type="button" class="btn btn-danger borrar" onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">Borrar</button></a> </td>
                </tr> <?php endforeach;
                endif; ?> </tbody>
    <tfoot>
        <tr>
            <td colspan="4"> <a href="index.php?c=l_facturas&m=nueva_l&id_factura=<?php echo $l_factura->factura_id; ?>&id_articulo=<?php echo $l_factura->factura_id; ?>">
    <button type="button" class="btn btn-primary">Nueva Línea</button>
</a>
 </td>
        </tr>
    </tfoot>
</table> <?php require("layout/footer.php"); ?>