<h3 class="Titulo">Gestión Subcategorías - Productos</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <?php if ($current_user['rol_id'] == 1) { ?>
        <th>Acciones</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($subcategoriaproductos)){
          foreach ($subcategoriaproductos as $index => $subcategoria) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $subcategoria['SubcategoriaProducto']['nombre'] ?></td>
              <td><?php echo $subcategoria['CategoriaProducto']['nombre'] ?></td>
              <?php if ($current_user['rol_id'] == 1) { ?>
              <td>
                <a href="/Hop/subcategoriaproductos/edit/<?php echo $subcategoria['SubcategoriaProducto']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/subcategoriaproductos/delete/<?php echo $subcategoria['SubcategoriaProducto']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la categoría ?');">
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
<a href="/Hop/subcategoriaproductos/add" class="Agregar btn btn-primary">Agregar</a>