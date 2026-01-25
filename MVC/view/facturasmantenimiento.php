<?php require("layout/header.php"); ?> 

<?php $cliente_actual = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : ''; ?>

<h1>Facturas</h1> 
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2> 

<form action="<?php echo 'index.php?c=facturas&m=' .  
             ($opcion == 'EDITAR' ? 'modificar&id=' . $factura->id : 'insertar'); ?>"  
      method="POST"> 

  <label for="cliente_id" class="form-label">Cliente</label>  
  <select name="cliente_id" id="cliente_id" class="form-control" required>
    <option value="">-- Selecciona un cliente --</option>
    <?php foreach ($clientes->filas as $cliente) : ?>
        <option value="<?= $cliente->id ?>" 
            <?= ($opcion == 'EDITAR' && $cliente->id == $factura->cliente_id) || ($cliente->id == $cliente_actual && $opcion != 'EDITAR') ? 'selected' : ''; ?>>
            <?= $cliente->nombre ?>
        </option>
    <?php endforeach; ?>
  </select>
  <br/> 

  <label for="numero" class="form-label">Número</label> 
  <input type="text" class="form-control" name="numero" id="numero"  
         value="<?php echo ($opcion == 'EDITAR' ? $factura->numero : ''); ?>" required/> 
  <br/> 

  <label for="fecha" class="form-label">Fecha</label>  
  <input type="datetime-local" class="form-control" name="fecha" id="fecha"  
         value="<?php echo ($opcion == 'EDITAR' ? $factura->fecha : ''); ?>" required/> 
  <br/>

  <input type="hidden" name="id_cliente_volver" value="<?= $cliente_actual; ?>">

  <button type="submit" class="btn btn-primary">Aceptar</button> 
  <a href="<?php echo URLSITE . '?c=facturas&m=verf' . ($cliente_actual ? '&id_cliente=' . $cliente_actual : ''); ?>"> 
      <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button> 
  </a> 

</form> 

<?php require("layout/footer.php"); ?>
