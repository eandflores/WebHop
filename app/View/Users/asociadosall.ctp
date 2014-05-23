<h3 class="Titulo">Gestión locales</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Rut</th>
        <th>Username</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($locales)){
          foreach ($locales as $index => $local) { 
            if($local['Local']['admin_id'] != null)  {?>
              <tr>
                <td><?php echo $index+1 ?></td>
                <td><?php echo $local['User']['rut'] ?></td>
                <td><?php echo $local['User']['username'] ?></td>
                <?php if($local['User']['estado'] == true){ ?>
                  <td><?php echo "Habilitado" ?></td>
                <?php } else{ ?>
                  <td><?php echo "Deshabilitado" ?></td>
                <?php } ?>
                <td>
                  <a href="/Hop/Users/view/<?php echo $local['User']['id'] ?>">
                    <i class='icon icon-zoom-in'></i>
                  </a>
                  <a href="/Hop/Users/edit/<?php echo $local['User']['id'] ?>">
                    <i class='icon icon-edit'></i>
                  </a>
                  <?php if($local['User']['estado'] != true) { ?>
                    <a href="/Hop/Users/enable/<?php echo $local['User']['id'] ?>" onclick="return confirm('Esta seguro que desea habilitar el local ?');">
                      <i class='icon icon-ok'></i>
                    </a>
                  <?php } else { ?>
                  <a href="/Hop/Users/disable/<?php echo $local['User']['id'] ?>" onclick="return confirm('Esta seguro que desea deshabilitar el local ?');">
                    <i class='icon icon-remove'></i>
                  </a>
                  <?php } ?>
                </td>
              </tr>
    <?php   } 
          }
        } else{ ?>
          <tr>
            <td colspan='6'>No hay locals en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
<a href="/Hop/Users/add" class="Agregar btn btn-primary">Agregar</a>