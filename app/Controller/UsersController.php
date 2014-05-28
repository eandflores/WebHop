<?php

	class UsersController extends AppController {

		public $name = 'Users';

		public $helpers = array('GoogleMap');

		var $uses = array('User','Rol','Comuna','Producto','Oferta','Local','Comentario','VotosLocal','CategoriaProducto','SubcategoriaProducto');

		var $sacaffold;

		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('index','add','guardar',
				'loginAndroid','actualizarEmail','actualizarNombre',
				'actualizarPassword','actualizarTelefono',
				'actualizarDireccion','getUsuario','getDatos',
				'search','logout');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index(){
			$comentarios_all= $this->Comentario->find('all',array(
				'order' => array('Comentario.created' => 'desc')
			));
			$this->set('comentarios', $comentarios_all);
			
		}

		public function all() {
			if( $this->current_user['rol_id'] == 1) { 
				$this->set('usuarios', $this->User->find('all',array(
					'order' => array('User.nombre')
				)));
			}
			else
				$this->redirect(array('action' => 'index'));
		}

		public function view($id) {
			$this->set('usuario', $this->User->read(null,$id));
		}

		public function add() {
			$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));
			$this->set('roles',$this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));

			if ($this->request->is('post')) {
				$rut = $this->request->data['rut'];
				$username = $this->request->data['username'];
				$email = $this->request->data['email'];
				$password = $this->request->data['password'];
				$password2 = $this->request->data['password2'];

				$this->set('rut', $rut);
				$this->set('username', $username);
				$this->set('email', $email);

				$this->set('nombre', $this->request->data['nombre']);
				$this->set('apellido_paterno', $this->request->data['apellido_paterno']);
				$this->set('apellido_materno', $this->request->data['apellido_materno']);
				$this->set('fecha_nacimiento', $this->request->data['fecha_nacimiento']);
				$this->set('poblacion', $this->request->data['poblacion']);
				$this->set('calle', $this->request->data['calle']);
				$this->set('numero', $this->request->data['numero']);

				$this->set('_rol', $this->request->data['rol_id']);
				$this->set('_comuna', $this->request->data['comuna_id']);
				$this->request->data['img']= "";

				$mensaje = '';

				if ($this->data['Image']) {
	                $image = $this->data['Image']['image'];
	                $imageTypes = array("image/gif", "image/jpeg", "image/png");
	                $uploadFolder = "img/upload/img_local";
	                $uploadPath = WWW_ROOT . $uploadFolder;
	               
	                foreach ($imageTypes as $type) {	
	                	if($image['type'] == ""){
	                		$mensaje = "VACIO";
	                		$this->request->data['img']='/Hop/img/user.png';
	                	}
	                    elseif ($type == $image['type']) {
	                        if ($image['error'] == 0) {
	                            $imageName = $image['name'];
	                            
	                            if (file_exists($uploadPath . '/' . $imageName)) 
	                                $imageName = date('His') . $imageName;
	                            
	                            $full_image_path = $uploadPath . '/' . $imageName;
	                            
	                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
	                                $mensaje ="EXITO";
	                                $this->set('imageName',$imageName);
	                                $ImagePath = '/Hop/img/upload/img_local/'.$imageName;
	            					$this->request->data['img']=$ImagePath;
	                            } 
	                            else
	                                $mensaje = 'Ha ocurrido un probema subiendo el archivo. Intente nuevamente.';
	                        } 
	                        else 
	                            $mensaje = 'Ha ocurrido un probema subiendo el archivo. Intente nuevamente.';
	                        break;
                    	} 	
                    	else 
                        	$mensaje = 'Tipo de archivo no soportado';
                	}
            	}


				if($mensaje == "EXITO" || $mensaje == "VACIO"){
					if(!empty($rut) && $rut != " "){
						if($this->User->findByrut($rut)){
							$this->Session->setFlash('El usuario no se pudo ingresar, el rut '.$rut.' ya esta registrado.','default', array("class" => "alert alert-error"));
						}
					} 
					elseif($this->User->findByusername($username)){
						$this->Session->setFlash('El usuario no se pudo ingresar, el username '.$username.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					elseif($this->User->findByemail($email)){
						$this->Session->setFlash('El usuario no se pudo ingresar, el mail '.$email.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					elseif($password != $password2){
						$this->Session->setFlash('El usuario no se pudo ingresar, los password no coinciden.','default', array("class" => "alert alert-error"));
					} 
					else{
						if ($this->User->save($this->request->data)) {
							$this->Session->setFlash('El usuario ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'all'));
						} 
						else 
							$this->Session->setFlash('El usuario no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
					} 
				}
				else
            		$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
			}
		}

		public function edit($id = null) {
			$this->set('usuario', $this->User->read(null,$id));

			$this->set('roles',$this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));
			$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));

			if ($this->request->is('post')) {

				$id = $this->request->data['id'];

				$rut = $this->request->data['rut'];
				$email = $this->request->data['email'];

				$this->set('id', $id);
				$this->set('rut', $rut);
				$this->set('email', $email);

				$this->set('nombre', $this->request->data['nombre']);
				$this->set('apellido_paterno', $this->request->data['apellido_paterno']);
				$this->set('apellido_materno', $this->request->data['apellido_materno']);
				$this->set('fecha_nacimiento', $this->request->data['fecha_nacimiento']);
				$this->set('poblacion', $this->request->data['poblacion']);
				$this->set('calle', $this->request->data['calle']);
				$this->set('numero', $this->request->data['numero']);
				$this->set('telefono_fijo', $this->request->data['telefono_fijo']);
				$this->set('telefono_movil', $this->request->data['telefono_movil']);

				$this->set('_rol', $this->request->data['rol_id']);
				$this->set('_comuna', $this->request->data['comuna_id']);
				$this->User->set(array('modified' => date("d-m-Y H:i:s")));
				
				$conditions1 = array("User.rut" => $rut, "User.rut !=" => ' ', "User.id !=" => $id);
				$conditions2 = array("User.email" => $email,"User.id !=" => $id);

				if ($this->data['Image']) {
	                $image = $this->data['Image']['image'];
	                $imageTypes = array("image/gif", "image/jpeg", "image/png");
	                $uploadFolder = "img/upload/img_user";
	                $uploadPath = WWW_ROOT . $uploadFolder;
	               
	                foreach ($imageTypes as $type) {
	                	if($image['type'] == ""){
	                		$mensaje = "VACIO";
	                	}
	                    elseif ($type == $image['type']) {
	                        if ($image['error'] == 0) {
	                            $imageName = $image['name'];
	                            
	                            if (file_exists($uploadPath . '/' . $imageName)) 
	                                $imageName = date('His') . $imageName;
	                            
	                            $full_image_path = $uploadPath . '/' . $imageName;
	                            
	                            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
	                                $mensaje ="EXITO";
	                                $this->set('imageName',$imageName);
	                                $ImagePath = '/Hop/img/upload/img_user/'.$imageName;
	            					$this->request->data['img']=$ImagePath;
	                            } 
	                            else
	                                $mensaje = 'Ha ocurrido un probema subiendo el archivo. Intente nuevamente.';
	                        } 
	                        else 
	                            $mensaje = 'Ha ocurrido un probema subiendo el archivo. Intente nuevamente.';
	                        break;
                    	} 	
                    	else 
                        	$mensaje = 'Tipo de archivo no soportado';
                	}
            	}

				if($mensaje == "EXITO" || $mensaje == "VACIO"){
					if($this->User->find('first', array('conditions' => $conditions1))){
						$this->Session->setFlash('El usuario no se pudo actualizar, el rut '.$rut.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					elseif($this->User->find('first', array('conditions' => $conditions2))){
						$this->Session->setFlash('El usuario no se pudo actualizar, el mail '.$email.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					else{
						debug($this->request->data);
						if ($this->User->save($this->request->data)) {
							$this->Session->setFlash('El usuario ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'all'));
						} 
						else{
							$this->Session->setFlash('El usuario no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
						}
					} 
				}
				else
            		$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
			}
		}

		public function disable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 

			else{
				$cont_admin = $this->User->find('count', array('conditions' => array('User.rol_id' => 1 , 'User.estado' => true)));
				$actual=$this->User->read(null,$id);
				if (($cont_admin > 1 && $actual['User']['rol_id'] == 1) || $actual['User']['rol_id'] != 1 ) {

					$this->User->set(array('estado' => false));
					$this->User->set(array('fecha_anulacion' => date("d-m-Y H:i:s")));

					if ($this->User->save()) {
						$this->Session->setFlash('El usuario ha sido deshabilitado','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'all'));
					} 
					else {
						$this->Session->setFlash('El usuario no fue deshabilitado.','default', array("class" => "alert alert-error"));
		        		$this->redirect(array('action' => 'all'));
					}
				}
				else {
					$this->Session->setFlash('No pueden estar todos los adminstradores deshabilitados.','default', array("class" => "alert alert-error"));
		        	$this->redirect(array('action' => 'all'));
				}
			}	
			
		}

		public function enable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {		
				$this->User->read(null,$id);
				$this->User->set(array('estado' => true));


				if ($this->User->save()) {
					$this->Session->setFlash('El usuario ha sido habilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'all'));
				} 
				else {
					$this->Session->setFlash('El usuario no fue habilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'all'));
				}
			}
		}

		public function login(){
			$logged_in = $this->Auth->loggedIn();

			if(!empty($logged_in)){
				$this->Session->setFlash('Usted ya ha iniciado sesión.','default', array("class" => "alert alert-warning"));
				$this->redirect(array('action' => 'index'));
			}

			if($this->request->is('post')){
				if($this->Auth->login()){
					$this->redirect($this->Auth->redirect());
				}
				else{
					$this->Session->setFlash('Error iniciando sesión, compruebe que su username y/o password sean correctos.','default', array("class" => "alert alert-error"));
        			$this->redirect(array('action' => 'login'));
				}
			}
		}

		public function asociadosall() {
			if( $this->current_user['rol_id'] == 1) { 
				$this->set('usuarios', $this->User->find('all',array(
					'order' => array('User.nombre')
				)));
			}
			else
				$this->redirect(array('action' => 'index'));
		}

		public function asociadosview($id) {
			$usuario = $this->User->read(null,$id);
			$conditions = array("Local.admin_id" => $usuario['User']['id']);
			$locales = $this->Local->find('all',array('conditions'=>$conditions));
			$conditions2 = array("Local.admin_id" => null);
			$locales_all = $this->Local->find('all',array('conditions'=>$conditions2));
			$this->set('usuario',$usuario);
			$this->set('locales',$locales);
			$this->set('locales_all',$locales_all);
		}

		public function asociadosadd($user_id = null) {

			if ($this->request->is('post')) {
				
				$locales_id = $this->request->data['locales'];
				$usuario = $this->request->data['usuario'];

				$cont=$this->Local->find('count', array('conditions' => array("Local.admin_id" => $usuario)));
				
				foreach($locales_id as $index => $local_id){
					$this->Local->read(null,$locales_id[$index]);
					$this->Local->set(array('admin_id' => $usuario));
					if ($this->Local->save()) {
						$cont = $cont-1;
					}	
				}
				
				if ($cont == 0 || $cont == -1) {
					$this->Session->setFlash('Los locales han sido asociados exitosamente.','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'asociadosall'));
				}
				else{
					$this->Session->setFlash('Los locales no fuerón asociados , intente nuevamente.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'asociadosall'));
				}	
			}
		}

		public function asociadosdelete($local_id = null){
			$this->Local->read(null,$local_id);
			$this->Local->set(array('admin_id' => null));

			if ($this->Local->save()) {
					$this->Session->setFlash('El local ha sido asociado exitosamente','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'asociadosall'));
				} 
			else {
				$this->Session->setFlash('El local no fue asociado exitosamente, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'asociadosall'));
			}			
		}

		public function logout(){
			$this->redirect($this->Auth->logout());
		}

		public function contrasena($id = null){
			
			if ($this->request->is('post')) {
				$usuario = $this->User->read(null,$this->current_user['id']);
				$passwordA = $this->request->data['passwordA'];
				$password1 = $this->request->data['password1'];
				$password2 = $this->request->data['password2'];

				if(AuthComponent::password($passwordA) == $usuario['User']['password']){
					if($password1 == $password2){
						$usuario['User']['password'] = $password2;
						if ($this->User->save($usuario)) {
							$this->Session->setFlash('Su cambio de password se realizo correctamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
					else
				$this->Session->setFlash('Sus password nuevos no coinciden','default', array("class" => "alert alert-error"));	
				}
			else
				$this->Session->setFlash('El password ingresado no coinside con su antiguo password','default', array("class" => "alert alert-error"));
			}
		}

		public function search(){
			
			$productos_all= $this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			));
			$comentarios_all= $this->Comentario->find('all',array(
				'order' => array('Comentario.created' => 'desc')
			));
			$this->set('comentarios', $comentarios_all);

			$votoslocal_all= $this->VotosLocal->find('all',array(
				'order' => array('VotosLocal.local_id' => 'desc')
			));
			$this->set('VotosLocal', $this->VotosLocal);

			foreach ($productos_all as $index => $producto){
				$productos[$index]=$producto['Producto']['nombre'];
			}
			
			$this->set('productos_all', $productos);

			if ($this->request->is('post')) {
				$nombre = $this->request->data['nombre'];
				$local_id = '';
			}
			elseif (!empty($this->params->query)){
				$nombre = $this->params->query['nomb'];
				$local_id = $this->params->query['loc'];
			}
			else{
				$this->redirect(array('action' => 'index'));
			}
			
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
			$nombre = strtolower(str_replace($no_permitidas, $permitidas ,$nombre));
			$nombre = ucwords ($nombre);
			$this->set('nombre', $nombre);
			$this->set('loc_id', $local_id);
			$conditions = array("Producto.nombre" => $nombre);
			$buscado=$this->Producto->find('first',array('conditions'=>$conditions));

			$conditionsN = array("Producto.nombre LIKE" => "%$nombre%");
			$buscadoN=$this->Producto->find('all',array('conditions'=>$conditionsN));
			
			if(!empty($buscado)){

				$this->Producto->read(null,$buscado['Producto']['id']);
				$visitas_producto=$buscado['Producto']['visitas']+1;
				$this->Producto->set(array('visitas' => $visitas_producto));
				$this->Producto->save();

				$buscado_id=$buscado['Producto']['id'];				
				$conditions2 = array("Oferta.producto_id" => $buscado_id);
				$buscado_oferta=$this->Oferta->find('all',array('conditions'=>$conditions2));

				if(!empty($buscado_oferta)){
					
					foreach ($buscado_oferta as $index => $busc_ofer) {
						$this->Oferta->read(null,$busc_ofer['Oferta']['id']);
						$visitas_oferta=$busc_ofer['Oferta']['visitas']+1;
						$this->Oferta->set(array('visitas' => $visitas_oferta));
						$this->Oferta->save();
					}

					$buscado_oferta = Set::sort($buscado_oferta, '{n}.Local.visitas', 'desc');
					$cont_local = count($buscado_oferta);
					$buscado_local = array();
					$indice = 1;
					$buscado_local[0]['Local'] = $buscado_oferta[0]['Local'];
					if($cont_local>1){
						for ($index=0;$index<$cont_local-1; $index++){
							if($buscado_oferta[$index]['Local']['id'] != $buscado_oferta[$index+1]['Local']['id']){
								$buscado_local[$indice]['Local'] = $buscado_oferta[$index+1]['Local'];
								$indice++;
							}
						}
					}
					$this->set('buscado_local',$buscado_local);

					
				}
				else 
					$this->Session->setFlash('El producto buscado no esta asociado a ningun local','default', array("class" => "alert alert-error"));
			}
			else 
				if(!empty($buscadoN)){
					$this->set('buscadoN',$buscadoN);
				}
				else	
					$this->Session->setFlash('El producto buscado no fue encontrado','default', array("class" => "alert alert-error"));
		}

		public function informes(){
			$categorias = $this->CategoriaProducto->find('all',array(
	 						'order' => 'CategoriaProducto.nombre'
	 					));

			$subcategorias = $this->SubcategoriaProducto->find('all',array(
	 						'order' => 'SubcategoriaProducto.nombre'
	 					));

			$productos = $this->Producto->find('all',array(
	 						'order' => 'Producto.nombre'
	 					));

			$locales = $this->Local->find('all',array(
	 						'order' => 'Local.nombre'
	 					));

			$marcas = $this->Oferta->find('all',array(
							'fields' => 'marca',
	 						'order' => 'Oferta.marca',
	 						'group' => 'marca'
	 					));

			$this->set('categorias', $categorias);
			$this->set('subcategorias', $subcategorias);
			$this->set('productos', $productos);
			$this->set('locales', $locales);
			$this->set('marcas', $marcas);
		}

		public function informes_locales(){
			
			$productos = $this->Producto->find('all',array(
	 						'order' => 'Producto.nombre'
	 					));

			$marcas = $this->Oferta->find('all',array(
							'fields' => 'marca',
	 						'order' => 'Oferta.marca',
	 						'group' => 'marca'
	 					));

			$this->set('productos', $productos);
			$this->set('marcas', $marcas);
		}

		public function informe() {
			$fecha_inicio = $this->request->data['fechaIni3'];
			$fecha_fin = $this->request->data['fechaFin3'];
			$rolUsuario = $this->request->data['rolUsuario'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('rolUsuario', $rolUsuario);

			$usuarios = array();

			if($rolUsuario == "Todos"){
				$usuarios = $this->User->find('all',array(
		 						'order' => 'User.created',
		 						'conditions' => array(
		 											'User.created >=' => $fecha_inicio.' 00:00:00',
		 											'User.created <=' => $fecha_fin.' 23:59:59',
		 										)
		 					));

			} else {
				$usuarios = $this->User->find('all',array(
		 						'order' => 'User.created',
		 						'conditions' => array(
		 											'User.created >=' => $fecha_inicio.' 00:00:00',
		 											'User.created <=' => $fecha_fin.' 23:59:59',
		 											"User.rol_id" => $rolUsuario
		 										)
		 					));
			}
			
			$this->set('roles', $this->Rol->find('all'));
			$this->set('usuarios', $usuarios);
		}

		public function informe_anulados() {
			$fecha_inicio = $this->request->data['fechaIni6'];
			$fecha_fin = $this->request->data['fechaFin6'];
			$rolUsuario = $this->request->data['rolUsuarioAnulado'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('rolUsuario', $rolUsuario);

			$usuarios = array();

			if($rolUsuario == "Todos"){
				$usuarios = $this->User->find('all',array(
		 						'order' => 'User.fecha_anulacion',
		 						'conditions' => array(
		 											'User.fecha_anulacion >=' => $fecha_inicio.' 00:00:00',
		 											'User.fecha_anulacion <=' => $fecha_fin.' 23:59:59',
		 											'User.estado' => false
		 										)
		 					));

			} else {
				$usuarios = $this->User->find('all',array(
		 						'order' => 'User.fecha_anulacion',
		 						'conditions' => array(
		 											'User.fecha_anulacion >=' => $fecha_inicio.' 00:00:00',
		 											'User.fecha_anulacion <=' => $fecha_fin.' 23:59:59',
		 											"User.rol_id" => $rolUsuario,
		 											'User.estado' => false
		 										)
		 					));
			}
			
			$this->set('roles', $this->Rol->find('all'));
			$this->set('usuarios', $usuarios);
		}

		#========================Android==========================#

		public function guardar(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';

			if ($this->request->is('post')){
				if($this->User->findByusername($this->request->data['username']))
					$mensaje = 'No se pudo completar el registro, el username '.$this->request->data['username'].' ya esta registrado.';
				elseif($this->User->findByemail($this->request->data['email']))
					$mensaje = 'No se pudo completar el registro, el mail '.$this->request->data['email'].' ya esta registrado.';
				elseif(!empty($this->request->data['rut'])){
					if($this->User->findByrut($this->request->data['rut']))
						$mensaje = 'No se pudo completar el registro, el rut '.$this->request->data['rut'].' ya esta registrado.';	
				}
				else{
					if ($this->User->save($this->request->data)){
						$conditions = array("User.username" => $this->request->data['username']);
						$usuario = $this->User->find('first', array('conditions' => $conditions));
						$mensaje = 'EXITO'; 
					}
					else
						$mensaje = 'Ha ocurrido un error durante el registro, intentelo nuevamente.'; 
				} 
			}

			$json['usuario'] = $usuario['User'];
			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function actualizarEmail(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';

			if ($this->request->is('post')){
				if($this->User->findByemail($this->request->data['email']))
					$mensaje = 'El email '.$this->request->data['email'].' ya esta registrado, no se pudo actualizar el email.';
				else{
					$usuario = $this->User->read(null,$this->request->data['id']);
					$usuario['User']['email'] = $this->request->data['email'];

					if ($this->User->save($usuario)) 
						$mensaje = 'EXITO'; 
					else
						$mensaje = 'No se pudo actualizar el email, intentelo nuevamente.'; 
				} 
			}

			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function actualizarNombre(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';

			if ($this->request->is('post')){
				
				$usuario = $this->User->read(null,$this->request->data['id']);
				$usuario['User']['nombre'] = $this->request->data['nombre'];
				$usuario['User']['apellido_paterno'] = $this->request->data['apellido_paterno'];
				$usuario['User']['apellido_materno'] = $this->request->data['apellido_materno'];

				if ($this->User->save($usuario)) 
					$mensaje = 'EXITO'; 
				else
					$mensaje = 'No se pudo actualizar el email, intentelo nuevamente.'; 
				
			}

			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function actualizarTelefono(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';

			if ($this->request->is('post')){
				
				$usuario = $this->User->read(null,$this->request->data['id']);
				$usuario['User']['telefono_fijo'] = $this->request->data['telefono_fijo'];
				$usuario['User']['telefono_movil'] = $this->request->data['telefono_movil'];

				if ($this->User->save($usuario)) 
					$mensaje = 'EXITO'; 
				else
					$mensaje = 'No se pudo actualizar el telefono, intentelo nuevamente.'; 
				
			}

			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function actualizarDireccion(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';

			if ($this->request->is('post')){
				
				$usuario = $this->User->read(null,$this->request->data['id']);
				$usuario['User']['poblacion'] = $this->request->data['poblacion'];
				$usuario['User']['calle'] = $this->request->data['calle'];
				$usuario['User']['numero'] = $this->request->data['numero'];
				$usuario['User']['region_id'] = $this->request->data['region_id'];
				$usuario['User']['comuna_id'] = $this->request->data['comuna_id'];

				if ($this->User->save($usuario)) 
					$mensaje = 'EXITO'; 
				else
					$mensaje = 'No se pudo actualizar la dirección, intentelo nuevamente.'; 
				
			}

			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function actualizarPassword(){
			$this->autoRender = false;

			$mensaje = '';
			$usuario = '';
			$password = '';

			if ($this->request->is('post')){
				
				$usuario = $this->User->read(null,$this->request->data['id']);

				if(AuthComponent::password($this->request->data['passwordAntiguo']) == $usuario['User']['password']){
					$usuario['User']['password'] = $this->request->data['passwordNuevo'];

					if ($this->User->save($usuario)){
						$mensaje = 'EXITO'; 
						$usuario = $this->User->read(null,$this->request->data['id']);
						$password = $usuario['User']['password'];
					}
					else
						$mensaje = 'No se pudo actualizar el password, intentelo nuevamente.'; 
				}
				else
					$mensaje = 'El password actual no es correcto.'; 
				
			}

			$json['password'] = $password;
			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function loginAndroid(){
			$this->autoRender = false;

			$mensaje = "";
			$usuario = "";

			if($this->request->is('post')){
				if($this->Auth->login()){
					$mensaje = "EXITO";
					$usuario_aux = $this->Auth->user();
					$usuario_aux2 = $this->User->read(null,$usuario_aux['id']);
					$usuario = $usuario_aux2['User'];
				}
				else
					$mensaje = 'Error iniciando sesión, compruebe que su username y/o password sean correctos.';
        			
			}

			$json['usuario'] = $usuario;
			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}

		public function getUsuario(){
			$this->autoRender = false;

			$usuario = '';

			if ($this->request->is('post')){
				$usuario = $this->User->read(null,$this->request->data['id']);
			}

			$json['usuario'] = $usuario['User'];
			echo json_encode($json);
		}

		public function getDatos(){
			$this->autoRender = false;

			$json = '';

			if ($this->request->is('post')){
				$comuna = $this->Comuna->read(null,$this->request->data['comuna']);
				$rol = $this->Rol->read(null,$this->request->data['rol']);
			}

			$json['comunaNombre'] = $comuna['Comuna']['nombre'];
			$json['rolNombre'] = $rol['Rol']['nombre'];
			echo json_encode($json);
		}

	}

?>