<div class="margenIndex">
  <h3 class="Titulo">Productos asociados al Local - <?php if(isset($local)){ echo $local['Local']['nombre']; } ?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Selección Locales ".date("d-m-Y"); ?>'>
  <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Marca</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Local</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $indice = 1;
          if(isset($ofertas)){
                foreach ($ofertas as $index => $oferta){
                  ?>
                    <tr>
                      <td><?php echo $indice; $indice ++;?></td>
                      <td><?php echo $oferta['Producto']['nombre'] ?></td>
                      <td><?php echo $oferta['Oferta']['marca'] ?></td>
                      <td><?php echo $oferta['Oferta']['descripcion'] ?></td>
                      <td><?php echo $oferta['Oferta']['precio'] ?></td>
                      <td><?php echo $oferta['Local']['nombre'] ?></td>
                    </tr>
            <?php } 
          }

          else{ ?>
            <tr>
              <td colspan='6'>No hay Ofertas en la Base de Datos</td>
            </tr>
      <?php } ?>
      </tbody>
  </table>
</div>  

<div class="margenIndex">
  <h3 class="Titulo">Agregar producto a Local - <?php if(isset($local)){ echo $local['Local']['nombre']; } ?></h3>
  <form style="margin-left:0px;" method="post" id="formOfertas">
    <table class="table table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Descripcion</th>
            <th>Selección</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(isset($productos)){
              foreach ($productos as $index => $producto) { ?>
                <tr>
                  <td><input type="checkbox" id="nombre<?php echo $index; ?>" name="productos[<?php echo $index; ?>];" value="<?php echo $producto['Producto']['id']; ?>" class="checkbox"></td>
                  <td><?php echo $producto['Producto']['nombre']; ?></td>
                  <td><?php echo $producto['SubcategoriaProducto']['nombre']; ?></td>
                  <td><input type="text" id="marca<?php echo $index ?>" name="marcas[<?php echo $index ?>];" placeholder="Marca" class="marca input-large"></td>
                  <td><input type="number" id="precio<?php echo $index ?>" name="precios[<?php echo $index ?>];" value="0" min="0" class="precio input-small"></td>
                  <td><textarea rows="1" style="width:450px; margin:auto; font-size:14px; font-weight:bold" id="descripcion<?php echo $index ?>" name="descripciones[<?php echo $index ?>];" placeholder="Descripción" maxlength="250"></textarea>
                  </td>
                  <td><input type="checkbox" id="nombre<?php echo $index; ?>" name="productos[<?php echo $index; ?>];" value="<?php echo $producto['Producto']['id']; ?>" class="checkbox"></td>
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
    <a href="/Hop/Productos/add" id="boton" style="width:auto" class="Agregar btn btn-primary">Agregar nuevo producto</a>
  </form>
</div>

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