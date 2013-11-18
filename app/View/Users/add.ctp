<form class="form-horizontal"  method="post">
    <fieldset>
        <?php if ($logged_in): ?>
            <legend>Agregar Usuario</legend>
        <?php else: ?>
            <legend>Registrarse</legend>
        <?php endif; ?>
    	<div class="control-group">
            <label class="control-label" for="inputRut">Rut:</label>
            <div class="controls">
              <input type="text" id="inputRut" name="rut" placeholder="Rut" maxlength="12" required>
            </div>
        </div>
        <?php 
        if ($logged_in): ?>
            <div class="control-group">
                <label class="control-label" for="selectRol">Rol:</label>
                <div class="controls">
                  <select id="selectRol" name="rol_id">
                    <?php if(isset($roles)){
                            foreach ($roles as $index => $rol) { ?>
                              <option value="<?php echo $rol['Rol']['id'] ?>"><?php echo $rol['Rol']['nombre'] ?></option>
                    <?php   }
                          } ?>
                  </select>
                </div>
            </div>
        <?php 
        else:
            $rol_val = 0; 
            if(isset($roles)){
                foreach ($roles as $index => $rol) { 
                    if($rol['Rol']['nombre'] == "Usuario")
                        $rol_val = $rol['Rol']['id'];
                }
            } 
        ?>
            <input type="hidden" id="inputRol" name="rol_id" value="<?php echo $rol_val ?>">
        <?php 
        endif; ?>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" placeholder="Nombre" maxlength="50" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoPat">Apellido Paterno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoPat" name="apellido_paterno" placeholder="Apellido Paterno" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoMat">Apellido Materno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoMat" name="apellido_materno" placeholder="Apellido Materno" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputFechaNac">Fecha de Nacimiento:</label>
            <div class="controls">
              <input type="date" id="inputFechaNac" name="fecha_nacimiento" max="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d") ?>" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email:</label>
            <div class="controls">
              <input type="email" id="inputEmail" name="email" placeholder="Email" maxlength="50" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputUsername">Username:</label>
            <div class="controls">
              <input type="text" id="inputUsername" name="username" placeholder="Username" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Password:</label>
            <div class="controls">
              <input type="password" id="inputPassword" name="password" placeholder="Password" maxlength="50" required>
            </div>
        </div>
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
        <div class="control-group">
            <label class="control-label" for="selectComuna">Comuna:</label>
            <div class="controls">
              <select id="selectComuna" name="comuna_id">
                <?php if(isset($comunas)){
                        foreach ($comunas as $index => $comuna) { ?>
                          <option value="<?php echo $comuna['Comuna']['id'] ?>"><?php echo $comuna['Comuna']['nombre'] ?></option>
                <?php 	}
                      } ?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPoblacion">Población:</label>
            <div class="controls">
              <input type="text" id="inputPoblacion" name="poblacion" placeholder="Población" maxlength="25" required>
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
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Users/all'">Atras</button>
        </div>
    </fieldset>
</form>