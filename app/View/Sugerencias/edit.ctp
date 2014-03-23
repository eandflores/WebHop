<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Editar Sugerencia</legend>
        <div class="control-group">
            <label class="control-label" for="inputTexto">Texto:</label>
            <div class="controls">
              <input type="text" id="inputTexto" name="texto" style="width: 424px; height: 30px;" value="<?php if(!empty($texto)){ echo $texto; } else { echo $sugerencia['Sugerencia']['texto']; } ?>" maxlength="500" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Sugerencias'">Atras</button>
        </div>
        <input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id; } else { echo $sugerencia['Sugerencia']['id']; } ?>" required>
    </fieldset>
</form>