<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Editar Rol Usuario</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" value="<?php if(!empty($nombre)){ echo $nombre; } else { echo $rol['Rol']['nombre']; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Rols'">Atras</button>
        </div>
    </fieldset>
</form>