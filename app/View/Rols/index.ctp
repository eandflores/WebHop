<h3 class="Titulo">Gestión Roles - Usuarios</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($roles)){
          foreach ($roles as $index => $rol) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $rol['Rol']['nombre'] ?></td>
              <td>
                <a href="/Hop/Rols/edit/<?php echo $rol['Rol']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/Rols/delete/<?php echo $rol['Rol']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar el rol ?');">
                  <i class='icon icon-remove'></i>
                </a>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='3'>No hay Roles en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
<a href="/Hop/Rols/add" class="Agregar btn btn-primary">Agregar</a>