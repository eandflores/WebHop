<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Escribir Comentario</legend>
        <div class="control-group">
            <label class="control-label" for="inputTexto">Comentario:</label>
            <div class="controls">
              <input type="text" id="inputTexto" name="texto" placeholder="Comentario" value="<?php if(!empty($texto)){ echo $texto; } ?>" maxlength="500" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop'">Atras</button>
        </div>
    </fieldset>
</form>
<script type="text/javascript">

</script>