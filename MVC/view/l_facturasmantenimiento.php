<?php require("layout/header.php"); ?>

<h1>Linea Factura</h1>
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<form action="index.php?c=l_facturas&m=<?= ($opcion == 'EDITAR' ? 'modificar&id=' . $l_factura->id : 'insertar') ?>&id_factura=<?= $factura_id_actual ?>" method="POST">

<?php if ($opcion == 'EDITAR'): ?>
    <input type="hidden" name="id" value="<?= $l_factura->id ?>">
<?php endif; ?>

    <label for="factura_id">Factura</label>
    <select name="factura_id" class="form-control" required>
        <option value="">-- Selecciona una factura --</option>
        <?php foreach ($facturas->filas as $factura) : ?>
            <option value="<?= $factura->id ?>"
                <?= ($opcion == 'EDITAR' && $factura->id == $l_factura->factura_id) ? 'selected' : '' ?>>
                Nº <?= $factura->numero ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br />

    <label for="articulo_id">Artículo</label>
   <select name="articulo_id" id="articulo_id" class="form-control">
    <option value="">-- Selecciona un artículo --</option>
    <?php foreach ($articulos->filas as $articulo) : ?>
        <option value="<?= $articulo->id ?>"
            data-referencia="<?= $articulo->referencia ?>"
            data-descripcion="<?= $articulo->descripcion ?>"
            data-precio="<?= $articulo->precio ?>"
            data-iva="<?= $articulo->iva ?>"
            <?= (isset($l_factura->articulo_id) && $l_factura->articulo_id == $articulo->id) ? 'selected' : '' ?>>
            <?= $articulo->referencia ?> - <?= $articulo->descripcion ?>
        </option>
    <?php endforeach; ?>
</select>

    <br />

    <label for="referencia">Referencia</label>
    <input type="text" name="referencia" id="referencia" class="form-control"
        value="<?= $l_factura->referencia ?? '' ?>" required>

    <br />

    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion" class="form-control"
        value="<?= $l_factura->descripcion ?? '' ?>" required>

    <br />

    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio" class="form-control"
        value="<?= $l_factura->precio ?? '' ?>" step="0.01" required>

    <br />

    <label for="iva">IVA</label>
    <input type="number" name="iva" id="iva" class="form-control"
        value="<?= $l_factura->iva ?? '' ?>" step="0.01" required>

    <br />

    <label for="cantidad">Cantidad</label>
    <input type="number" name="cantidad" id="cantidad" class="form-control"
        value="<?= $l_factura->cantidad ?? '' ?>" required>

    <br />

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?= URLSITE . '?c=l_facturas&m=verl&id_factura=' . $factura_id_actual ?>" class="btn btn-secondary">Cancelar</a>
</form>

<script>
    // JS para autocompletar campos al seleccionar artículo
    const selectArticulo = document.getElementById('articulo_id');
selectArticulo.addEventListener('change', function() {
    const option = this.selectedOptions[0];
    document.getElementById('referencia').value = option.dataset.referencia || '';
    document.getElementById('descripcion').value = option.dataset.descripcion || '';
    document.getElementById('precio').value = parseFloat(option.dataset.precio || 0).toFixed(2);
    document.getElementById('iva').value = parseFloat(option.dataset.iva || 0).toFixed(2);
});

</script>

<?php require("layout/footer.php"); ?>
