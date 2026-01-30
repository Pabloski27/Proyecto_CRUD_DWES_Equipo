<?php require("layout/header.php"); ?>

<h1>FACTURAS</h1>

<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-left">
            <th>Id</th>
            <th>Nombre</th>
            <th>numero</th>
            <th>fecha</th>
            <th>base</th>
            <th>Importe IVA</th>
            <th>Importe</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($factura->filas) :
            foreach ($factura->filas as $fila) :
        ?>
                <tr>
                    <td style="text-align: left; width: 5%;"><?php echo htmlspecialchars($fila->id); ?></td>
                    <td><?php echo htmlspecialchars($fila->cliente_nombre); ?></td>
                    <td><?php echo htmlspecialchars($fila->numero); ?></td>
                    <td><?php echo $fila->fecha; ?></td>
                    <td><?= number_format($fila->base, 2) ?> €</td>
                    <td><?= number_format($fila->iva_total, 2) ?> €</td>
                    <td><?= number_format($fila->total, 2) ?> €</td>

                    <td style="text-align: right; width: 50%;">
                        <a href="index.php?c=facturas&m=editar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-success">Editar</button></a>
                        <a href="index.php?c=facturas&m=borrar&id=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-danger borrar"
                                onclick="return confirm('¿Estás seguro de borrar el registro <?php
                                                                                                echo $fila->id; ?>?');">Borrar</button></a>
                        <a href="index.php?c=l_facturas&m=verl&id_factura=<?php echo $fila->id; ?>">
                            <button type="button" class="btn btn-warning">Lineas</button></a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <a href="index.php?c=facturas&m=nuevof<?php echo isset($_GET['id_cliente']) ? '&id_cliente=' . $_GET['id_cliente'] : ''; ?>">
                    <button type="button" class="btn btn-primary">Nueva Factura</button>
                </a>

            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>