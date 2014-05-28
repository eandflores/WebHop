<div class="margenIndex">
    <?php 
      $mensaje = '';

      if($tipoLocal == "Todos"){ 
        $mensaje = "Listado Locales Anulados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($tipoLocal == "Administrados"){ 
        $mensaje = "Listado Locales Administrados Anulados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
        $mensaje = "Listado Locales Sin Administrar Anulados (".$fecha_inicio."/".$fecha_fin.")"; 
      } 
    ?>
  <h3 class="Titulo"><?php echo $mensaje?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>
  
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <?php if($tipoLocal != "SinAdministrar") { ?>
            <th>Administrador</th>
          <?php } ?>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($locales)){
            foreach ($locales as $index => $local) { ?>
              <tr>
                <td><?php echo $index+1; ?></td>
                <td><?php echo $local['Local']['nombre']; ?></td>
                <?php if($local['Local']['estado'] == true){ ?>
                        <td><?php echo "Habilitado" ?></td>
                      <?php } else{ ?>
                        <td><?php echo "Deshabilitado" ?></td>
                      <?php } ?>
                <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                <td><?php echo $local['User']['username']; ?></td>
                <?php if($tipoLocal != "SinAdministrar") { ?>
                  <td>
                    <?php 
                      foreach ($usuarios as $index => $usuario) { 
                          if($usuario['User']['id'] == $local['Local']['admin_id']){
                            echo $usuario['User']['username']; 
                            break;
                          }
                      }
                    ?>
                  </td>
                <?php } ?>
                <td><?php echo substr($local['Local']['fecha_anulacion'],0,10); ?></td>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='6'>No hay locales en la Base de Datos.</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="javascript:void(0)" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
</div>