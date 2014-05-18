<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Escribir Sugerencia</legend>
        <div class="control-group">
            <label class="control-label" for="inputTexto">Sugerencia:</label>
            <div class="controls">
                <textarea rows="3" style="width:480px;font-size:14px; font-weight:bold" type="text" id="inputTexto" name="texto" placeholder="Sugerencia" value="<?php if(!empty($texto)){ echo $texto; } ?>" maxlength="500" required>
                </textarea>
                <input type="hidden" name="user_id" value="<?php echo $current_user['id']; ?>">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop'">Atras</button>
        </div>
    </fieldset>
</form>
