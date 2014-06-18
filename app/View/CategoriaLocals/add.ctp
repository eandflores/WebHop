<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Agregar Categoría Local</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" placeholder="nombre" value="<?php if(!empty($nombre)){ echo $nombre; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/CategoriaLocals'">Atras</button>
        </div>
    </fieldset>
</form>