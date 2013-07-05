<h3>Gestión Categorías - Productos</h3>
<a href="/Hop/CategoriaProductos/add" class="Agregar btn btn-primary">Agregar</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($categoriaproductos)){
          foreach ($categoriaproductos as $index => $categoria) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $categoria['CategoriaProducto']['nombre'] ?></td>
              <td>
                <a href="/Hop/CategoriaProductos/edit/<?php echo $categoria['CategoriaProducto']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/CategoriaProductos/delete/<?php echo $categoria['CategoriaProducto']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la categoría ?');">
                  <i class='icon icon-remove' ></i>
                </a>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='3'>No hay Categorías en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>