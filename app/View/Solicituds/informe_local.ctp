<div class="margenIndex">
    <?php 
      $mensaje = '';

      if($estado == "Todos"){ 
        $mensaje = "Listado Solicitudes Aprobadas y Rechazadas (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($estado == "Aprobado"){ 
        $mensaje = "Listado Solicitudes Aprobadas (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($estado == "Rechazado"){ 
        $mensaje = "Listado Solicitudes Rechazadas (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($estado == "Creadas"){ 
        $mensaje = "Listado Solicitudes Creadas (".$fecha_inicio."/".$fecha_fin.")"; 
      }
    ?>
  <h3 class="Titulo"><?php echo $mensaje?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>
  
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Acción</th>
          <th>Tabla</th>
          <th>campos</th>
          <th>Usuario</th>
          <?php if($estado != "Creadas") { ?>
            <th>Administrador</th>
          <?php } ?>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($solicitudes)){
            foreach ($solicitudes as $index => $solicitud) { ?>
              <tr>
                <td><?php echo $index+1; ?></td>
                <td><?php echo $solicitud['Solicitud']['accion']; ?></td>
                <td><?php echo $solicitud['Solicitud']['tabla']; ?></td>
                <td><?php echo $solicitud['Solicitud']['campos']; ?></td>
                <td><?php echo $solicitud['User']['username']; ?></td>
                <?php if($estado != "Creadas") { ?>
                  <td>
                    <?php 
                      foreach ($usuarios as $index => $usuario) { 
                          if($usuario['User']['id'] == $solicitud['Solicitud']['admin_id']){
                            echo $usuario['User']['username']; 
                            break;
                          }
                      }
                    ?>
                  </td>
                <?php } ?>
                <td>
                  <?php 
                  if($estado == "Creadas"){
                    echo substr($solicitud['Solicitud']['created'],0,10); 
                  }
                  else{
                    echo substr($solicitud['Solicitud']['modified'],0,10); 
                  } ?>
                </td>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='6'>No hay solicitudes en la Base de Datos.</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="javascript:void(0)" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
</div>