<form class="form-horizontal" method='post' action='/Hop/users/login' style='padding-left:100px' id='UserLoginForm'>
	<fieldset>
        <legend>Iniciar Sesión</legend>
		<div class="control-group">
			<label class="control-label" for="inputUsername">Username:</label>
		    <div class="controls">
		      <input type="text" id="inputUsername" name='data[User][username]' placeholder="Username" required>
		    </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Password:</label>
		    <div class="controls">
		      <input type="password" id="inputPassword" name='data[User][password]' placeholder="Password" required>
		    </div>
		</div>
		<div class='form-actions'>
		 	<button type='submit' class='btn btn-success' value='Login'>Iniciar Sesión</button>
		 	<button type='reset' href='/Hop' class='btn btn-danger'>Cancelar</button>
		</div>
	</fieldset>
</form>