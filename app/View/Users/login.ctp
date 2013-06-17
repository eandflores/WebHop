<?php if(isset($error)){ ?>
		<div class="alert alert-error">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Error iniciando sesión.</strong>
		  	Username o Password incorrecto, inténtelo de nuevo
		</div>
<?php } ?>
<?php $this->Session->flash(); ?>
<form class="form-horizontal"  style="padding-left:100px;" method='post'>
	<fieldset>
        <legend>Iniciar Sesión</legend>
		<?php $this->Session->flash('Auth'); ?>
		<div class="control-group">
			<label class="control-label" for="username">Username:</label>
		    <div class="controls">
		      <input type="text" id="username" name='username' placeholder="Username" required	>
		    </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password:</label>
		    <div class="controls">
		      <input type="password" id="password" name='password' placeholder="Password" required>
		    </div>
		</div>
		<div class='form-actions'>
		 	<button type='submit' class='btn btn-success'><i class='icon-user'></i> Iniciar Sesión</button>
		 	<button type='reset' class='btn btn-warning'><i class='icon-remove'></i> Cancelar</button>
		</div>
	</fieldset>
</form>