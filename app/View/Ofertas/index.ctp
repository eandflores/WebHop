<div class="margenIndex">
  <h3 class="Titulo">Gestión de Productos asociados a locáles</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Selección Locales ".date("d-m-Y"); ?>'>
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Marca</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Local</th>
          <th>Usuario</th>
          <th>Fecha de Creación</th>
          <th>Fecha de Actualización</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $indice = 1;
          if(isset($ofertas)){
                foreach ($ofertas as $index => $oferta){?>
                    <tr>
                      <td><?php echo $indice; $indice ++;?></td>
                      <td><?php echo $oferta['Producto']['nombre'] ?></td>
                      <td><?php echo $oferta['Oferta']['marca'] ?></td>
                      <td><?php echo $oferta['Oferta']['descripcion'] ?></td>
                      <td><?php echo $oferta['Oferta']['precio'] ?></td>
                      <td><?php echo $oferta['Local']['nombre'] ?></td>
                      <td><?php echo $oferta['User']['username'] ?></td>
                      <td><?php echo $oferta['Oferta']['created'] ?></td>
                      <td><?php echo $oferta['Oferta']['modified'] ?></td>
                      <td>
                        <?php if($oferta['Local']['admin_id'] == null || $current_user['rol_id'] == 3 ){ ?>  
                          <a href="/Hop/Ofertas/edit/<?php echo $oferta['Oferta']['id'] ?>">
                            <i class='icon icon-edit'></i>
                          </a>
                          <a href="/Hop/Ofertas/delete/<?php echo $oferta['Oferta']['id'] ?>" onclick="return confirm('Esta seguro que desea eliminar el producto de este local ?');">
                            <i class='icon icon-remove'></i>
                          </a>
                        <?php } ?>
                      </td>
                    </tr>
            <?php } 
          }

          else{ ?>
            <tr>
              <td colspan='9'>No hay Ofertas en la Base de Datos</td>
            </tr>
      <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Ofertas/locales" class="Agregar btn btn-primary">Agregar</a>
</div>  