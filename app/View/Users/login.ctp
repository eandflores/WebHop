<?php if(isset($error)){ ?>
		<div class="alert alert-error">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Error iniciando sesión.</strong>
		  	Username o Password incorrecto, inténtelo de nuevo
		</div>
<?php } ?>
<?php $this->Session->flash(); ?>
<h2>Iniciar Sesión</h2>
<?php
	echo $this->Form->create();
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->end('Login');
?>