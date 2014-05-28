<div class="margenIndex">
  <?php 
      $mensaje = '';

      if($categoria == "Todas" && $subcategoria == "Todas"){ 
        $mensaje = "Listado Productos Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($subcategoria != "Todas"){ 
        $mensaje = "Listado Productos Subcategoria ".$subcat['SubcategoriaProducto']['nombre']." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
        $mensaje = "Listado Productos Categoria ".$cat['CategoriaProducto']['nombre']." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } 
  ?>
  <h3 class="Titulo"><?php echo $mensaje; ?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Subcategoría</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <th>Visitas</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($productos)){
            foreach ($productos as $index => $producto) { ?>
              <tr>
                <td><?php echo $index+1 ?></td>
                <td><?php echo $producto['Producto']['nombre'] ?></td>
                <td><?php echo $producto['SubcategoriaProducto']['nombre'] ?></td>
                <td>
                  <?php 
                    foreach ($categorias as $index => $categ) { 
                      if($categ['CategoriaProducto']['id'] == $producto['SubcategoriaProducto']['categoria_producto_id']){
                        echo $categ['CategoriaProducto']['nombre'];
                      }
                    }
                  ?>
                </td>
                <td><?php echo $producto['User']['username']?></td>
                <td><?php echo $producto['Producto']['visitas'] ?></td>
                <td>
                  <?php echo substr($producto['Producto']['created'],0,10); ?>
                </td>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='7'>No hay Productos en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Productos/add" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
</div>