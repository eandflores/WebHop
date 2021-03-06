<div class="margenIndex"> 
  <h3 class="Titulo">Gestión Productos</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Productos ".date("d-m-Y"); ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Subcategoría</th>
          <th>Usuario</th>
          <th>Acciones</th>
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
                <td><?php echo $producto['User']['username']?></td>
                <td>
                  <a href="/Hop/Productos/edit/<?php echo $producto['Producto']['id'] ?>">
                    <i class='icon icon-edit'></i>
                  </a>
                  <a href="/Hop/Productos/delete/<?php echo $producto['Producto']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar el producto ?');">
                    <i class='icon icon-remove'></i>
                  </a>
                </td>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='5'>No hay Productos en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Productos/add" class="Agregar btn btn-primary">Agregar</a>
</div>