<?php

	class UsersController extends AppController {
		
		public $name = 'Users';

		var $uses = array('User','Rol','Region','Comuna');

		var $sacaffold;

		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('index','add');
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
				
				$this->guardar($this->request->data)
				$mensaje = '';

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

				$json = array(
					'mensaje' => $mensaje
				);

				echo json_encode($json);
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
	}
?>