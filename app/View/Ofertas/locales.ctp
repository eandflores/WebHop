<h3 class="Titulo">Seleccionar Local al cual quiere asociar un Producto</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Categoría</th>
        <th>Usuario</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($locales)){ 
          if($current_user['rol_id']=="3"){
                foreach ($locales as $index => $local) { 
                  if($current_user['id'] == $local['Local']['admin_id']){?>
                    <tr>
                      <td><input type="radio" name="select" value="<?php echo $local['Local']['id']; ?>" class="select"></td>
                      <td><?php echo $local['Local']['nombre']; ?></td>
                      <?php if($local['Local']['estado'] == true){ ?>
                        <td><?php echo "Habilitado"; ?></td>
                      <?php } else{ ?>
                        <td><?php echo "Deshabilitado"; ?></td>
                      <?php } ?>
                      <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                      <td><?php echo $local['User']['username']; ?></td>
                    </tr>
            <?php }
            }
          } 
          if($current_user['rol_id'] !="3"){
            foreach ($locales as $index => $local) { ?>
              <tr>
                <td><input type="radio" name="select" value="<?php echo $local['Local']['id']; ?>" class="select"></td>
                <td><?php echo $local['Local']['nombre']; ?></td>
                <?php if($local['Local']['estado'] == true){ ?>
                  <td><?php echo "Habilitado"; ?></td>
                <?php } else{ ?>
                  <td><?php echo "Deshabilitado"; ?></td>
                <?php } ?>
                <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                <td><?php echo $local['User']['username']; ?></td>
              </tr>
            <?php } 
          }

        } else{ ?>
          <tr>
            <td colspan='5'>No hay Locales en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
<a href="javascript:void(0);" class="Agregar btn btn-primary">Siguiente</a>

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