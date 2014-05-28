<div class="margenIndex">
    <?php 
      $mensaje = '';

      if($rolUsuario == "Todos"){ 
        $mensaje = "Listado Usuarios Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
          foreach ($roles as $index => $rol) { 
            if($rolUsuario == $rol['Rol']['id']){
              $mensaje = "Listado Usuarios Creados Rol ".$rol['Rol']['nombre']." (".$fecha_inicio."/".$fecha_fin.")"; 
              break;
            }
          }
      } 
    ?>
  <h3 class="Titulo"><?php echo $mensaje?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>
  
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Correo</th>
          <th>Estado</th>
          <?php if($rolUsuario == "Todos") { ?>
            <th>Rol</th>
          <?php } ?>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($usuarios)){
            foreach ($usuarios as $index => $usuario) { ?>
              <tr>
                <td><?php echo $index+1; ?></td>
                <td><?php echo $usuario['User']['username']; ?></td>
                <td><?php echo $usuario['User']['email']; ?></td>
                <?php if($usuario['User']['estado'] == true){ ?>
                  <td><?php echo "Habilitado" ?></td>
                <?php } else{ ?>
                  <td><?php echo "Deshabilitado" ?></td>
                <?php } ?>
                <?php if($rolUsuario == "Todos") { ?>
                  <td>
                    <?php 
                      foreach ($roles as $index => $rol) { 
                          if($usuario['User']['rol_id'] == $rol['Rol']['id']){
                            echo $rol['Rol']['nombre']; 
                            break;
                          }
                      }
                    ?>
                  </td>
                <?php } ?>
                <td><?php echo substr($usuario['User']['created'],0,10); ?></td>
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