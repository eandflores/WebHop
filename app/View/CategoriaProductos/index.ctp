<div class="margenIndex">
  <h3 class="Titulo">Gestión Categorías - Productos</h3>
  <input type="hidden" class="TituloExport" value='<?php echo "Listado Categorías de Productos ".date("d-m-Y"); ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <?php if ($current_user['rol_id'] == 1) { ?>
          <th>Acciones</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($categoriaproductos)){
            foreach ($categoriaproductos as $index => $categoria) { ?>
              <tr>
                <td><?php echo $index+1 ?></td>
                <td><?php echo $categoria['CategoriaProducto']['nombre'] ?></td>
                <?php if ($current_user['rol_id'] == 1) { ?>
                <td>
                  <a href="/Hop/CategoriaProductos/edit/<?php echo $categoria['CategoriaProducto']['id'] ?>">
                    <i class='icon icon-edit'></i>
                  </a>
                  <a href="/Hop/CategoriaProductos/delete/<?php echo $categoria['CategoriaProducto']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la categoría ?');">
                    <i class='icon icon-remove' ></i>
                  </a>
                </td>
                <?php } ?>
              </tr>
      <?php } 
          } else{ ?>
            <tr>
              <td colspan='3'>No hay Categorías en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/CategoriaProductos/add" class="Agregar btn btn-primary">Agregar</a>
</div>