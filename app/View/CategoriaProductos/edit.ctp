<form class="form-horizontal well"  method="post">
    <fieldset>
        <legend>Editar Categoría Producto</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre:</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="nombre" value="<?php echo $categoria['CategoriaProducto']['nombre'] ?>" maxlength="25" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/CategoriaProductos'">Atras</button>
        </div>
    </fieldset>
</form>