<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Agregar productos asociado a local</legend>

        <div class="control-group">
            <label class="control-label" for="selectProducto">Producto:</label>
            <div class="controls">
              <select id="selectLocal" name="producto_id">
                <?php if(isset($productos)){
                        foreach ($productos as $index => $producto) {
                          if(!empty($_producto) && $_producto == $producto['Producto']['id']){ ?>
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

        <?php if($current_user['rol_id']!="3"){?>
        <div class="control-group">
            <label class="control-label" for="selectLocal">Local:</label>
            <div class="controls">
              <select id="selectLocal" name="local_id">
                <?php if(isset($locales)){
                        foreach ($locales as $index => $local) {
                          if(!empty($_local) && $_local == $local['Local']['id']){ ?>
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
        <?php }?>

        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio:</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="precio" placeholder="Precio" value="<?php if(!empty($precio)){ echo $precio; } ?>" min="0">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Ofertas'">Atras</button>
        </div>
    </fieldset>
</form>
<script type="text/javascript">

</script>