<?php

	App::uses('BaseAuthenticate', 'Controller/Component/Auth');

	class HopAuth  {
	    public function authenticate(CakeRequest $request, CakeResponse $response) {
	        $usuario = $request->data["usuario"];
	        $password = md5($request->data["password"]);
	        $db = new BaseDatos();
	        $response = $db->select_query("SELECT usuario.*,rol.rol_nombre FROM usuario,rol WHERE usuario.usu_rut='$usuario' AND usuario.usu_password='$password' AND usuario.rol_id=rol.rol_id");
	        if(!is_null($response)){
	        	$_SESSION["usuario"] = $response[0];
	        	if($_SESSION["usuario"]->usu_estado=="Habilitado")
	        		return array("Administrador");
	        }
	    }
	}

?>