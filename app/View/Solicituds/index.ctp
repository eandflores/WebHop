<div class="margenIndex">
  <h3 class="Titulo">Solicitudes Pendientes</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Solicitudes Pendientes ".date("d-m-Y"); ?>'>

  <table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Estado</th>
        <th>Acción</th>
        <th>Tabla Afectada</th>
        <th>campos</th>
        <th>Fecha de creación</th>
        <th>Fecha de modificación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
     
      <?php 
        if(isset($solicitudes)){
          foreach ($solicitudes as $index => $solicitud) {  ?>
            <tr>
              <td><?php echo $index; ?></td>
              <td><?php echo $solicitud['Solicitud']['estado'] ?></td>
              <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
              <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
              <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
              <td><?php echo $solicitud['Solicitud']['created'] ?></td>
              <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
              <td>
                <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                  <i class='icon icon-zoom-in'></i>
                </a>
                <?php if($current_user['id'] == 3 || $solicitud['Solicitud']['local_id'] == null ) { ?>
                          <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                            <i class='icon icon-ok'></i>
                          </a>
                          <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                          <i class='icon icon-remove'></i>
                        </a>
                <?php } ?>
              </td>
            </tr>
        <?php 
        } 
      }  

        else{ ?>
          <tr>
            <td colspan='8'>No hay Sugerencias en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>