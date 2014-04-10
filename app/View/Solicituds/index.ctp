<h3 class="Titulo">Gestión Solicitudes</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Estado</th>
        <th>Consulta Sql</th>
        <th>Acción</th>
        <th>Tabla Afectada</th>
        <th>campos</th>
        <th>Fecha de creación</th>
        <th>Fecha de modificación</th>
        <th>Usuario</th>
        <th>Administrador</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
     
      <?php 
        if(isset($solicitudes)){
          foreach ($solicitudes as $index => $solicitud) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
              <td><?php echo "Rechazado" ?></td>
              <?php }?>
              <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
              <td><?php echo "Aprobado" ?></td>
              <?php }?>
              <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
              <td><?php echo "Pendiente" ?></td>
              <?php }?>
              <!-- Obtener Texto de Sql --> 
              <?php if(strlen($solicitud['Solicitud']['sql']) > 80) { 
              ?>
                <td><?php echo substr($solicitud['Solicitud']['sql'],0,80) ?>...</td>
              <?php 
              } 
              else{ 
              ?>
                <td><?php echo $solicitud['Solicitud']['sql'] ?></td>
              <?php 
              }
              ?>
             <!-- Obtener Texto de Sql --> 
              <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
              <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
              <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
              <td><?php echo $solicitud['Solicitud']['created'] ?></td>
              <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
              <td><?php echo $solicitud['User']['nombre'] ?></td>
              <td><?php echo $solicitud['Solicitud']['admin_id'] ?></td>
              <td>
                <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                  <i class='icon icon-zoom-in'></i>
                </a>
                <a href="/Hop/Solicituds/edit/<?php echo $solicitud['Solicitud']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/Solicituds/delete/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la solicitud ?');">
                  <i class='icon icon-remove'></i>
                </a>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='10'>No hay Sugerencias en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
