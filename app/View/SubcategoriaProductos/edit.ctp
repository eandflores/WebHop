<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Editar Producto</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" value="<?php if(!empty($nombre)){ echo $nombre; } else { echo $subcategoria['SubcategoriaProducto']['nombre']; } ?>" maxlength="30" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectCategoriaProducto">Categoría:</label>
            <div class="controls">
              <select id="selectCategoriaProducto" name="categoria_producto_id">
                <?php if(isset($categorias)){
                        foreach ($categorias as $index => $categoria) {
                          if(!empty($_categoria) && $_categoria == $categoria['CategoriaProducto']['id']){ ?>
                            <option value="<?php echo $categoria['CategoriaProducto']['id']; ?>" selected>
                              <?php echo $categoria['CategoriaProducto']['nombre']; ?>
                            </option>
                    <?php }
                          elseif($subcategoria['CategoriaProducto']['id'] == $categoria['CategoriaProducto']['id']){ ?>
                            <option value="<?php echo $categoria['CategoriaProducto']['id'] ?>" selected><?php echo $categoria['CategoriaProducto']['nombre'] ?></option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $categoria['CategoriaProducto']['id'] ?>"><?php echo $categoria['CategoriaProducto']['nombre'] ?></option>
                    <?php } 
                        }
                      } ?>
              </select>
              <a href="/Hop/CategoriaProductos/add" id="boton" style="width:auto; margin-bottom:0px;" class="Agregar btn btn-primary">Agregar categoria de producto</a>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Productos'">Atras</button>
        </div>
        <input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id; } else { echo $subcategoria['SubcategoriaProducto']['id']; } ?>" required>
    </fieldset>
</form>