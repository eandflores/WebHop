 <h3 class="Titulo">Agregar producto a Local - <?php if(isset($local)){ echo $local['Local']['nombre']; } ?></h3>
 <form method="post" id="formOfertas">
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($productos)){
            foreach ($productos as $index => $producto) { ?>
              <tr>
                <td><input type="checkbox" id="nombre<?php echo $index; ?>" name="productos[<?php echo $index; ?>];" value="<?php echo $producto['Producto']['id']; ?>" class="checkbox"></td>
                <td><?php echo $producto['Producto']['nombre']; ?></td>
                <td><?php echo $producto['CategoriaProducto']['nombre']; ?></td>
                <td><input type="number" id="precio<?php echo $index ?>" name="precios[<?php echo $index ?>];" value="0" min="0" class="precio input-small"></td>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='5'>No hay Productos en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <input type="submit" value="Agregar Productos" class="Agregar btn btn-primary">
  <input type="hidden" name="local" value="<?php if(isset($local)){ echo $local['Local']['id']; } ?>">
</form>
<script type="text/javascript">
  jQuery(document).ready(function() {  
    $('#formOfertas').submit(function(){
      var cont = 0;
 
      $('.checkbox').each(function(){
        if($(this).is(':checked')){
          cont = cont + 1;
        }
      });

      if(cont == 0){
        alertify.error('Debe seleccionar al menos un producto.');
        return false;
      }
      else{
        return true;
      }
    });
  });
</script>