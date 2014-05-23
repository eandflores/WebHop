<div class="margenIndex">
  <h3 class="Titulo">Seleccionar Local al cual quiere asociar un Producto</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Selección Locales ".date("d-m-Y"); ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <th>Selección</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($locales)){ 
            if($current_user['rol_id']=="3"){
                  foreach ($locales as $index => $local) { 
                    if($current_user['local_id'] == $local['Local']['id']){?>
                      <tr>
                        <td><?php echo $index+1 ?></td>
                        <td><?php echo $local['Local']['nombre']; ?></td>
                        <?php if($local['Local']['estado'] == true){ ?>
                          <td><?php echo "Habilitado"; ?></td>
                        <?php } else{ ?>
                          <td><?php echo "Deshabilitado"; ?></td>
                        <?php } ?>
                        <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                        <td><?php echo $local['User']['username']; ?></td>
                         <td><input type="radio" name="select" value="<?php echo $local['Local']['id']; ?>" class="select"></td>
                      </tr>
              <?php }
              }
            } 
            if($current_user['rol_id'] !="3"){
              foreach ($locales as $index => $local) { ?>
                <tr>
                  <td><?php echo $index+1 ?></td>
                  <td><?php echo $local['Local']['nombre']; ?></td>
                  <?php if($local['Local']['estado'] == true){ ?>
                    <td><?php echo "Habilitado"; ?></td>
                  <?php } else{ ?>
                    <td><?php echo "Deshabilitado"; ?></td>
                  <?php } ?>
                  <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                  <td><?php echo $local['User']['username']; ?></td>
                  <td><input type="radio" name="select" value="<?php echo $local['Local']['id']; ?>" class="select"></td>
                </tr>
              <?php } 
            }

          } else{ ?>
            <tr>
              <td colspan='6'>No hay Locales en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="javascript:void(0);" class="Agregar btn btn-primary">Siguiente</a>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {  
    
    $('.Agregar').attr('href','javascript:void(0);');

    $('.select').click(function(){
      $('.Agregar').attr('href','/Hop/Ofertas/add/'+$(this).val());
    });

    $('.Agregar').click(function(){
      if($(this).attr('href') == 'javascript:void(0);' ){
        alertify.error('Debe seleccionar algún local.');
      }
    });

  });
</script>