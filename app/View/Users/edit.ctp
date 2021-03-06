<style type="text/css">
  
  .control-group img{
    width: 100px;
    height: 100px;
    border-radius: 5px;
    border: 5px ridge lightgrey; 
    display: block;
    margin-left: 150px;
    margin-bottom: 15px;
  }

</style>

<form class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <fieldset>
        <?php if ($logged_in): ?>
          <legend>Editar Usuario - <?php echo $current_user['username'] ?></legend>
        <?php else: ?>
          <legend>Configurar Cuenta</legend>
        <?php endif; ?>
        <div class="control-group">
          <img src="<?php echo $usuario['User']['img'] ?>">
          <input style="margin-left:40px;" type="file" name="data[Image][image]" id="ImageImage">
        </div>
        <div class="control-group">
            <label class="control-label" for="inputRut">Rut:</label>
            <div class="controls">
              <input type="text" id="inputRut" name="rut" value="<?php if(!empty($rut)){ echo $rut; } else { echo $usuario['User']['rut']; } ?>" maxlength="12">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombres:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" value="<?php if(!empty($nombre)){ echo $nombre; } else { echo $usuario['User']['nombre']; } ?>" maxlength="50">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoPat">Apellido Paterno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoPat" name="apellido_paterno" value="<?php  if(!empty($apellido_paterno)){ echo $apellido_paterno; } else { echo $usuario['User']['apellido_paterno']; } ?>" maxlength="25">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputApellidoMat">Apellido Materno:</label>
            <div class="controls">
              <input type="text" id="inputApellidoMat" name="apellido_materno" value="<?php if(!empty($apellido_materno)){ echo $apellido_materno; } else { echo $usuario['User']['apellido_materno']; } ?>" maxlength="25">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputFechaNac">Fecha de Nacimiento:</label>
            <div class="controls">
              <input type="date" id="inputFechaNac" name="fecha_nacimiento" max="<?php echo date("Y-m-d") ?>" value="<?php if(!empty($fecha_nacimiento)){ echo $fecha_nacimiento; } else { echo $usuario['User']['fecha_nacimiento']; } ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email:</label>
            <div class="controls">
              <input type="email" id="inputEmail" name="email" value="<?php if(!empty($email)){ echo $email; } else { echo $usuario['User']['email']; } ?>" maxlength="50" required>
            </div>
        </div>
        <?php if($current_user['rol_id']=="1"){ ?>
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
                            elseif(empty($_rol) && $usuario['Rol']['id'] == $rol['Rol']['id']){ ?>
                              <option value="<?php echo $rol['Rol']['id']; ?>" selected>
                                <?php echo $rol['Rol']['nombre']; ?>
                              </option>
                      <?php }
                            else{ ?>
                              <option value="<?php echo $rol['Rol']['id']; ?>">
                                <?php echo $rol['Rol']['nombre']; ?>
                              </option>
                      <?php } 
                          }
                        } ?>
                </select>
              </div>
          </div>
          <?php } ?>
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
                          elseif($usuario['Comuna']['id'] == $comuna['Comuna']['id']){ ?>
                            <option value="<?php echo $comuna['Comuna']['id']; ?>" selected>
                              <?php echo $comuna['Comuna']['nombre']; ?>
                            </option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $comuna['Comuna']['id']; ?>">
                              <?php echo $comuna['Comuna']['nombre']; ?>
                            </option>
                <?php     }
                        }
                      } ?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPoblacion">Población:</label>
            <div class="controls">
              <input type="text" id="inputPoblacion" name="poblacion" value="<?php if(!empty($poblacion)){ echo $poblacion; } else { echo $usuario['User']['poblacion']; } ?>" maxlength="25" >
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputCalle">Calle:</label>
            <div class="controls">
              <input type="text" id="inputCalle" name="calle" value="<?php if(!empty($calle)){ echo $calle; } else { echo $usuario['User']['calle']; } ?>" maxlength="25" >
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputNumero">Numero:</label>
            <div class="controls">
              <input type="number" id="inputNumero" name="numero" value="<?php if(!empty($numero)){ echo $numero; } else { echo $usuario['User']['numero']; } ?>" min="0">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputTelefonoFijo">Teléfono Fijo:</label>
            <div class="controls">
              <input type="number" id="inputTelefonoFijo" name="telefono_fijo" value="<?php if(!empty($telefono_fijo)){ echo $telefono_fijo; } else {  echo $usuario['User']['telefono_fijo']; } ?>" min="0">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputTelefonoMovil">Teléfono Móvil:</label>
            <div class="controls">
              <input type="number" id="inputTelefonoMovil" name="telefono_movil" value="<?php if(!empty($telefono_movil)){ echo $telefono_movil; } else {  echo $usuario['User']['telefono_movil']; } ?>" min="0">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.history.back()">Atras</button>
        </div>
        <input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id; } else { echo $usuario['User']['id']; } ?>" required>
    </fieldset>
</form>