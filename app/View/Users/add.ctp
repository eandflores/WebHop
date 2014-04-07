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
              <input type="text" id="inputRut" name="rut" placeholder="Rut" value="<?php if(!empty($rut)){ echo $rut; } ?>" maxlength="12" required>
            </div>
        </div>
        <?php 
        if ($logged_in): ?>
            <div class="control-group">
                <label class="control-label" for="selectRol">Rol:</label>
                <div class="controls">
                  <select id="selectRol" name="rol_id">
                    <?php if(isset($roles)){
                            foreach ($roles as $index => $rol) { 
                              if(!empty($_rol) && $_rol == $rol['Rol']['id']){ ?>
                                <option value="<?php echo $rol['Rol']['id']; ?>" selected>
                                    <?php echo $rol['Rol']['nombre']; ?>
                                </option>
                        <?php }
                              else{ ?>
                                <option value="<?php echo $rol['Rol']['id'] ?>">
                                    <?php echo $rol['Rol']['nombre']; ?>
                                </option>
                        <?php }
                            }
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
              <input type="text" id="inputNombre" name="nombre" placeholder="Nombre" value="<?php if(!empty($nombre)){ echo $nombre; } ?>" maxlength="50" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoPat">Apellido Paterno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoPat" name="apellido_paterno" placeholder="Apellido Paterno" value="<?php if(!empty($apellido_paterno)){ echo $apellido_paterno; } ?>"maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoMat">Apellido Materno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoMat" name="apellido_materno" placeholder="Apellido Materno" value="<?php if(!empty($apellido_materno)){ echo $apellido_materno; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputFechaNac">Fecha de Nacimiento:</label>
            <div class="controls">
              <input type="date" id="inputFechaNac" name="fecha_nacimiento" max="<?php echo date("Y-m-d") ?>" value="<?php if(!empty($fecha_nacimiento)){ echo $fecha_nacimiento; } else { echo date("Y-m-d"); } ?>" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email:</label>
            <div class="controls">
              <input type="email" id="inputEmail" name="email" placeholder="Email" value="<?php if(!empty($email)){ echo $email; } ?>" maxlength="50" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputUsername">Username:</label>
            <div class="controls">
              <input type="text" id="inputUsername" name="username" placeholder="Username" value="<?php if(!empty($username)){ echo $username; } ?>" maxlength="25" required>
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
                          if(!empty($_region) && $_region == $region['Region']['id']){ ?>
                            <option value="<?php echo $region['Region']['id']; ?>" selected>
                            	<?php echo $region['Region']['nombre']; ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $region['Region']['id']; ?>">
                            	<?php echo $region['Region']['nombre']; ?>
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
                        foreach ($comunas as $index => $comuna) { 
                          if(!empty($_comuna) && $_comuna == $comuna['Comuna']['id']){ ?>
                            <option value="<?php echo $comuna['Comuna']['id']; ?>" selected>
                                <?php echo $comuna['Comuna']['nombre']; ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $comuna['Comuna']['id']; ?>">
                                <?php echo $comuna['Comuna']['nombre']; ?>
                            </option>
                    <?php } 
                     	}
                      } ?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPoblacion">Población:</label>
            <div class="controls">
              <input type="text" id="inputPoblacion" name="poblacion" placeholder="Población" value="<?php if(!empty($poblacion)){ echo $poblacion; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputCalle">Calle:</label>
            <div class="controls">
              <input type="text" id="inputCalle" name="calle" placeholder="Calle" value="<?php if(!empty($calle)){ echo $calle; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputNumero">Numero:</label>
            <div class="controls">
              <input type="number" id="inputNumero" name="numero" placeholder="Número" value="<?php if(!empty($numero)){ echo $numero; } ?>" min="0" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Users/all'">Atras</button>
        </div>
    </fieldset>
</form>