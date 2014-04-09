<h3 class="Titulo">Gestión de Productos asociados a locáles</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Local</th>
        <th>Precio</th>
        <th>Usuario</th>
        <th>Fecha de Actualización</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $indice = 1;
        if(isset($ofertas)){
          if($current_user['rol_id']=="3"){
              foreach ($ofertas as $index => $oferta) { 
                if($current_user['local_id'] == $oferta['Local']['id']){?>
                  <tr>
                    <td><?php echo $indice; $indice ++;?></td>
                    <td><?php echo $oferta['Producto']['nombre'] ?></td>
                    <td><?php echo $oferta['Local']['nombre'] ?></td>
                    <td><?php echo $oferta['Oferta']['precio'] ?></td>
                    <td><?php echo $oferta['User']['username'] ?></td>
                    <td><?php echo $oferta['Oferta']['modified'] ?></td>
                    <td>
                      <a href="/Hop/Ofertas/edit/<?php echo $oferta['Oferta']['id'] ?>">
                        <i class='icon icon-edit'></i>
                      </a>
                      <a href="/Hop/Ofertas/delete/<?php echo $oferta['Oferta']['id'] ?>" onclick="return confirm('Esta seguro que desea eliminar el producto de este local ?');">
                        <i class='icon icon-remove'></i>
                      </a>
                    </td>
                  </tr>
          <?php }
          } 
        } 

        if($current_user['rol_id']!="3"){
              foreach ($ofertas as $index => $oferta){?>
                  <tr>
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $oferta['Producto']['nombre'] ?></td>
                    <td><?php echo $oferta['Local']['nombre'] ?></td>
                    <td><?php echo $oferta['Oferta']['precio'] ?></td>
                    <td><?php echo $oferta['User']['username'] ?></td>
                    <td><?php echo $oferta['Oferta']['modified'] ?></td>
                    <td>
                      <a href="/Hop/Ofertas/edit/<?php echo $oferta['Oferta']['id'] ?>">
                        <i class='icon icon-edit'></i>
                      </a>
                      <a href="/Hop/Ofertas/delete/<?php echo $oferta['Oferta']['id'] ?>" onclick="return confirm('Esta seguro que desea eliminar el producto de este local ?');">
                        <i class='icon icon-remove'></i>
                      </a>
                    </td>
                  </tr>
          <?php }
          } 
        }

        else{ ?>
          <tr>
            <td colspan='7'>No hay Ofertas en la Base de Datos</td>
          </tr>
    <?php } ?>
    </tbody>
</table>
<a href="/Hop/Ofertas/add" class="Agregar btn btn-primary">Agregar</a>