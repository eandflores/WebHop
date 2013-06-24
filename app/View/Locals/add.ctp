<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Agregar Local</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" placeholder="Nombre" maxlength="30" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectCategoriaLocal">Categoría:</label>
            <div class="controls">
              <select id="selectCategoriaLocal" name="categoria_local_id">
                <?php if(isset($categorias)){
                        foreach ($categorias as $index => $categoria) {
                          if($index == 0){ ?>
                            <option value="<?php echo $categoria['CategoriaLocal']['id'] ?>" selected>
                            	<?php echo $categoria['CategoriaLocal']['nombre'] ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $categoria['CategoriaLocal']['id'] ?>">
                            	<?php echo $categoria['CategoriaLocal']['nombre'] ?>
                            </option>
                    <?php } 
                        }
                      } ?>
              </select>
            </div>
        </div>
        <?php /*
        <div class="control-group">
            <label class="control-label" for="selectRegion">Region:</label>
            <div class="controls">
              <select id="selectRegion" name="region_id">
                <?php if(isset($regiones)){
                        foreach ($regiones as $index => $region) {
                          if($index == 0){ ?>
                            <option value="<?php echo $region['Region']['id'] ?>" selected>
                                <?php echo $region['Region']['nombre'] ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $region['Region']['id'] ?>">
                                <?php echo $region['Region']['nombre'] ?>
                            </option>
                    <?php } 
                        }
                      } ?>
              </select>
            </div>
        </div>
        */ ?>
        <div class="control-group">
            <label class="control-label" for="selectComuna">Comuna:</label>
            <div class="controls">
              <select id="selectComuna" name="comuna_id">
                <?php if(isset($comunas)){
                        foreach ($comunas as $index => $comuna) { ?>
                          <option value="<?php echo $comuna['Comuna']['id'] ?>"><?php echo $comuna['Comuna']['nombre'] ?></option>
                <?php   }
                      } ?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputCalle">Calle:</label>
            <div class="controls">
              <input type="text" id="inputCalle" name="calle" placeholder="Calle" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputNumero">Numero:</label>
            <div class="controls">
              <input type="number" id="inputNumero" name="numero" placeholder="Número" min="0" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputTelefonoFijo">Teléfono Fijo:</label>
            <div class="controls">
              <input type="number" id="inputTelefonoFijo" name="telefono_fijo" placeholder="Teléfono Fijo" min="0">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputTelefonoMovil">Teléfono Móvil:</label>
            <div class="controls">
              <input type="number" id="inputTelefonoMovil" name="telefono_movil" placeholder="Teléfono Móvil" min="0">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email:</label>
            <div class="controls">
              <input type="email" id="inputEmail" name="email" placeholder="Email" maxlength="50">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputSitioWeb">Sitio Web:</label>
            <div class="controls">
              <input type="text" id="inputSitioWeb" name="sitio_web" placeholder="Sitio Web" maxlength="50">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop'">Atras</button>
        </div>
    </fieldset>
</form>