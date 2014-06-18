<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Editar productos asociado a local</legend>

        <div class="control-group">
            <label class="control-label" for="selectProducto">Producto:</label>
            <div class="controls">
              <select id="selectLocal" name="producto_id" disabled>
                <?php if(isset($productos)){
                        foreach ($productos as $index => $producto) {
                          if(!empty($_producto) && $_producto == $producto['Producto']['id']){ ?>
                            <option value="<?php echo $producto['Producto']['id']; ?>" selected>
                                <?php echo $producto['Producto']['nombre']; ?>
                            </option>
                    <?php }
                           elseif(empty($_producto) && $oferta['Producto']['id'] == $producto['Producto']['id']){ ?>
                            <option value="<?php echo $producto['Producto']['id']; ?>" selected>
                              <?php echo $producto['Producto']['nombre']; ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $producto['Producto']['id']; ?>">
                                <?php echo $producto['Producto']['nombre']; ?>
                            </option>
                    <?php } 
                        }
                      } ?>
              </select>
            </div>
        </div>

          <div class="control-group">
              <label class="control-label" for="selectLocal">Local:</label>
              <div class="controls">
                <select id="selectLocal" name="local_id" disabled>
                  <?php if(isset($locales)){
                          foreach ($locales as $index => $local) {
                            if(!empty($_local)&&$_local == $local['Local']['id']){ ?>
                              <option value="<?php echo $local['Local']['id']; ?>" selected>
                                  <?php echo $local['Local']['nombre']; ?>
                              </option>
                      <?php }
                             elseif(empty($_local) && $oferta['Local']['id'] == $local['Local']['id']){ ?>
                              <option value="<?php echo $local['Local']['id']; ?>" selected>
                                <?php echo $local['Local']['nombre']; ?>
                              </option>
                      <?php }
                            else{ ?>
                              <option value="<?php echo $local['Local']['id']; ?>">
                                  <?php echo $local['Local']['nombre']; ?>
                              </option>
                      <?php } 
                          }
                        } ?>
                </select>
              </div>
          </div>

        <div class="control-group">
            <label class="control-label" for="inputMarca">Marca:</label>
            <div class="controls">
              <input type="number" id="inputMarca" name="marca" placeholder="Marca" value="<?php if(!empty($marca)){ echo $marca; } else {  echo $oferta['Oferta']['marca']; } ?>" min="0">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio:</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="precio" placeholder="Precio" value="<?php if(!empty($precio)){ echo $precio; } else {  echo $oferta['Oferta']['precio']; } ?>" min="0">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputDescripcion">Descripcion:</label>
            <div class="controls">
              <input type="text" id="inputDescripcion" name="descripcion" placeholder="Descripcion" value="<?php if(!empty($descripcion)){ echo $descripcion; } else {  echo $oferta['Oferta']['descripcion']; } ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Ofertas'">Atras</button>
        </div>
    </fieldset>
</form>