<h3 class="Titulo">Gestión Usuarios</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Rut</th>
        <th>Username</th>
        <th>Estado</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($usuarios)){
          foreach ($usuarios as $index => $usuario) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $usuario['User']['rut'] ?></td>
              <td><?php echo $usuario['User']['username'] ?></td>
              <?php if($usuario['User']['estado'] == true){ ?>
                <td><?php echo "Habilitado" ?></td>
              <?php } else{ ?>
                <td><?php echo "Deshabilitado" ?></td>
              <?php } ?>
              <td><?php echo $usuario['Rol']['nombre']?></td>
              <td>
                <a href="/Hop/Users/view/<?php echo $usuario['User']['id'] ?>">
                  <i class='icon icon-zoom-in'></i>
                </a>
                <a href="/Hop/Users/edit/<?php echo $usuario['User']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <?php if($usuario['User']['estado'] != true) { ?>
                  <a href="/Hop/Users/enable/<?php echo $usuario['User']['id'] ?>" onclick="return confirm('Esta seguro que desea habilitar el usuario ?');">
                    <i class='icon icon-ok'></i>
                  </a>
                <?php } else { ?>
                <a href="/Hop/Users/disable/<?php echo $usuario['User']['id'] ?>" onclick="return confirm('Esta seguro que desea deshabilitar el usuario ?');">
                  <i class='icon icon-remove'></i>
                </a>
                <?php } ?>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='6'>No hay Usuarios en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
<a href="/Hop/Users/add" class="Agregar btn btn-primary">Agregar</a>