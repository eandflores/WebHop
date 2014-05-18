<form class="form-horizontal"  method="post">
    <fieldset>
        <?php if ($logged_in): ?>
          <legend>Cambiar Contraseña - <?php echo $current_user['username'] ?></legend>
        <?php else: ?>
          <legend>Configurar Cuenta</legend>
        <?php endif; ?>

        <div class="control-group">
            <label class="control-label" for="inputPasswordA">Ingrese su Antiguo Password:</label>
            <div class="controls">
              <input type="password" id="inputPasswordA" name="passwordA" placeholder="Password Antiguo" maxlength="50" required>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPassword1">Ingrese su Nuevo Password:</label>
            <div class="controls">
              <input type="password" id="inputPassword1" name="password1" placeholder="Password Nuevo 1" maxlength="50" required>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPassword2">Reingrese su Nuevo Password:</label>
            <div class="controls">
              <input type="password" id="inputPassword2" name="password2" placeholder="Password Nuevo 2" maxlength="50" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop'">Atras</button>
        </div>
        <input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id; } else { echo $current_user['id']; } ?>" required>
    </fieldset>
</form>