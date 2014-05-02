<?php

	class UsersController extends AppController {
		
		public $name = 'Users';

		var $uses = array('User','Rol','Region','Comuna');

		var $sacaffold;

		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('index','add','guardar',
				'loginAndroid','actualizarEmail','actualizarNombre',
				'actualizarPassword');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index(){

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

				$this->set('rut', $this->request->data['rut']);
				$this->set('username', $this->request->data['username']);
				$this->set('email', $this->request->data['email']);
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
				
				if($this->User->findByrut($this->request->data['rut'])){
					$mensaje = 'El usuario no se pudo ingresar, el rut '.$this->request->data['rut'].' ya esta registrado.';
					$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
				} 
				elseif($this->User->findByusername($this->request->data['username'])){
					$mensaje = 'El usuario no se pudo ingresar, el username '.$this->request->data['username'].' ya esta registrado.';
					$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
				} 
				elseif($this->User->findByemail($this->request->data['email'])){
					$mensaje = 'El usuario no se pudo ingresar, el mail '.$this->request->data['email'].' ya esta registrado.';
					$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
				} 
				else{
					if ($this->User->save($this->request->data)) {
						$mensaje = 'El usuario ha sido guardado exitosamente.';
						$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'all'));
					} 
					else{
						$mensaje = 'El usuario no fue guardado, intente nuevamente.';
						$this->Session->setFlash($mensaje,'default', array("class" => "alert alert-error"));
					} 
				} 
			}
		}

		public function edit($id = null) {
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
				
				$conditions1 = array("User.rut" => $rut,"User.id !=" => $id);
				$conditions2 = array("User.email" => $email,"User.id !=" => $id);

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
		}

		public function disable($id) {
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

		public function logout(){
			$this->redirect($this->Auth->logout());
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

			$json['usuario'] = $mensaje;
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
	}
?>