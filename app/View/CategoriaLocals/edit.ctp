<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Editar Categoría Local</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" value="<?php if(!empty($nombre)){ echo $nombre; } else { echo $categoria['CategoriaLocal']['nombre']; } ?>" maxlength="25" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/CategoriaLocals'">Atras</button>
        </div>
        <input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id; } else { echo $categoria['CategoriaLocal']['id']; } ?>" required>
    </fieldset>
</form>