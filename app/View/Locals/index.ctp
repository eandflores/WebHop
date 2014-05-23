<div class="margenIndex">
  <?php
  if($current_user['rol_id']!="3"){?>
  <h3 class="Titulo">Gestión de Locales</h3>
  <?php } 
  else{?>
  <h3 class="Titulo">Gestionar Local (es)</h3>
  <?php } ?>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Locales ".date("d-m-Y"); ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 

          $indice = 1;
          if(isset($locales)){ 
            if($current_user['rol_id']=="3"){
                  foreach ($locales as $index => $local) { 
                    if($current_user['local_id'] == $local['Local']['id']){?>
                      <tr>
                        <td><?php echo $indice; $indice ++; ?></td>
                        <td><?php echo $local['Local']['nombre'] ?></td>
                        <?php if($local['Local']['estado'] == true){ ?>
                          <td><?php echo "Habilitado" ?></td>
                        <?php } else{ ?>
                          <td><?php echo "Deshabilitado" ?></td>
                        <?php } ?>
                        <td><?php echo $local['CategoriaLocal']['nombre'] ?></td>
                        <td><?php echo $local['User']['username']?></td>
                        <td>
                          <a href="/Hop/Locals/view/<?php echo $local['Local']['id'] ?>">
                            <i class='icon icon-zoom-in'></i>
                          </a>
                          <a href="/Hop/Locals/edit/<?php echo $local['Local']['id'] ?>">
                            <i class='icon icon-edit'></i>
                          </a>
                        </td>
                      </tr>
        <?php }
            } 
          }

            if($current_user['rol_id'] !="3"){
                  foreach ($locales as $index => $local) {?>
                      <tr>
                        <td><?php echo $index+1 ?></td>
                        <td><?php echo $local['Local']['nombre'] ?></td>
                        <?php if($local['Local']['estado'] == true){ ?>
                          <td><?php echo "Habilitado" ?></td>
                        <?php } else{ ?>
                          <td><?php echo "Deshabilitado" ?></td>
                        <?php } ?>
                        <td><?php echo $local['CategoriaLocal']['nombre'] ?></td>
                        <td><?php echo $local['User']['username']?></td>
                        <td>
                          <a href="/Hop/Locals/view/<?php echo $local['Local']['id'] ?>">
                            <i class='icon icon-zoom-in'></i>
                          </a>
                          <a href="/Hop/Locals/edit/<?php echo $local['Local']['id'] ?>">
                            <i class='icon icon-edit'></i>
                          </a>
                          <?php if($local['Local']['estado'] != true) { ?>
                            <a href="/Hop/Locals/enable/<?php echo $local['Local']['id'] ?>" onclick="return confirm('Esta seguro que desea habilitar el local ?');">
                              <i class='icon icon-ok'></i>
                            </a>
                          <?php } else { ?>
                          <a href="/Hop/Locals/disable/<?php echo $local['Local']['id'] ?>" onclick="return confirm('Esta seguro que desea deshabilitar el local ?');">
                            <i class='icon icon-remove'></i>
                          </a>
                          <?php } ?>
                        </td>
                      </tr>
        <?php }          
            } 
        }

         else{ ?>
            <tr>
              <td colspan='6'>No hay Locales en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>

  <?php
  if($current_user['rol_id']!="3"){?>
  <a href="/Hop/Locals/add" class="Agregar btn btn-primary">Agregar</a>
  <?php } ?>
</div>