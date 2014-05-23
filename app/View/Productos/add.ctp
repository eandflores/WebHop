<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Agregar Producto</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" placeholder="Nombre" value="<?php if(!empty($nombre)){ echo $nombre; } ?>" maxlength="30" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectSubcategoriaProducto">Subcategoría:</label>
            <div class="controls">
              <select id="selectSubcategoriaProducto" name="subcategoria_producto_id">
                <?php if(isset($subcategorias)){
                        foreach ($subcategorias as $index => $subcategoria) {
                          if(!empty($_subcategoria) && $_subcategoria == $subcategoria['SubcategoriaProducto']['id']){ ?>
                            <option value="<?php echo $subcategoria['SubcategoriaProducto']['id']; ?>" selected>
                            	<?php echo $subcategoria['SubcategoriaProducto']['nombre']; ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $subcategoria['SubcategoriaProducto']['id']; ?>">
                            	<?php echo $subcategoria['SubcategoriaProducto']['nombre']; ?>
                            </option>
                    <?php } 
                        }
                      } ?>
              </select>
              <a href="/Hop/SubcategoriaProductos/add" id="boton" style="width:auto; margin-bottom:0px;" class="Agregar btn btn-primary">Agregar subcategoria de producto</a>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Productos'">Atras</button>
        </div>
    </fieldset>
</form>