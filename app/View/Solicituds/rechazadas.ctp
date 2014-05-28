<div class="margenIndex">
  <h3 class="Titulo">Solicitudes Rechazadas</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Solicitudes Rechazadas ".date("d-m-Y"); ?>'>

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