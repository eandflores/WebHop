<?php

	class UsersController extends AppController {

		public $name = 'Users';

		public $helpers = array('GoogleMap');

		var $uses = array('User','Rol','Region','Comuna','Producto','Oferta','Local','Comentario','VotosLocal');

		var $sacaffold;

		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('index','add','search','logout');
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
			$this->set('usuarios', $this->User->find('all',array(
				'order' => array('User.nombre')
			)));
		}

		public function view($id) {
			$this->set('usuario', $this->User->read(null,$id));
		}

		public function add() {
			$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
			)));
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
				$this->set('_region', $this->request->data['region_id']);
				$this->set('_comuna', $this->request->data['comuna_id']);
				$this->request->data['img']= "";

				$mensaje = '';

				if ($this->data['Image']) {
	                $image = $this->data['Image']['image'];
	                $imageTypes = array("image/gif", "image/jpeg", "image/png");
	                $uploadFolder = "img/upload/img_user";
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
					if($this->User->findByrut($rut)){
						$this->Session->setFlash('El usuario no se pudo ingresar, el rut '.$rut.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					elseif($this->User->findByusername($username)){
						$this->Session->setFlash('El usuario no se pudo ingresar, el username '.$username.' ya esta registrado.','default', array("class" => "alert alert-error"));
					} 
					elseif($this->User->findByemail($email)){
						$this->Session->setFlash('El usuario no se pudo ingresar, el mail '.$email.' ya esta registrado.','default', array("class" => "alert alert-error"));
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

		function edit($id = null) {
			$this->set('usuario', $this->User->read(null,$id));

			$this->set('roles',$this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));
			$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
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
				$this->set('_region', $this->request->data['region_id']);
				$this->set('_comuna', $this->request->data['comuna_id']);
				$this->User->set(array('modified' => date("d-m-Y H:i:s")));
				
				$conditions1 = array("User.rut" => $rut,"User.id !=" => $id);
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

		function disable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->User->read(null,$id);
				$this->User->set(array('estado' => false));

				if ($this->User->save()) {
					$this->Session->setFlash('El usuario ha sido deshabilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'all'));
				} 
				else {
					$this->Session->setFlash('El usuario no fue deshabilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'all'));
				}
			}
			
		}

		function enable($id) {
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
			else{
				$nombre = $this->params->query['nomb'];
				$local_id = $this->params->query['loc'];
			}
				$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
				$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
				$nombre = strtolower(str_replace($no_permitidas, $permitidas ,$nombre));
				$this->set('nombre', $nombre);
				$this->set('loc_id', $local_id);
				$conditions = array("Producto.nombre" => $nombre);
				$buscado=$this->Producto->find('first',array('conditions'=>$conditions));

				$conditionsN = array("Producto.nombre LIKE" => "%$nombre%");
				$buscadoN=$this->Producto->find('all',array('conditions'=>$conditionsN));
				
				if(!empty($buscado)){
					$buscado_id=$buscado['Producto']['id'];
					$conditions2 = array("Oferta.producto_id" => $buscado_id);
					$buscado_oferta=$this->Oferta->find('all',array('conditions'=>$conditions2));
					if(!empty($buscado_oferta)){
						$buscado_oferta = Set::sort($buscado_oferta, '{n}.Local.votos_positivos', 'desc');
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

	}
?>